<?php

ini_set('memory_limit', '2048M');
ini_set('max_execution_time', '3600');

class CTireParser{

    private $reader = null;

    //it's a kind of magic
    function __construct($parentClassName){
        $this->reader = new $parentClassName();
    }

    //it's a kind of magic
    function __call($name, $args){
        return call_user_func_array(array($this->reader, $name), $args);
    }

    //переопределение родительской функции пути к файлу
    function setSource($path){
        return $this->reader->setSource($path);
    }


    //присвоение шаблона
    public function setTemplate($template){
        if (isset($template))
            $this->_template=$template;
    }

	function parseData() {
        //получение данных
        $rawData=$this->reader->fetchData();

        //Сохраняем исходные строки для отправки письмом
        foreach ($rawData as $rd)
        {
            $pure[]=implode(' ',$rd);
        }

        //массив cформированный из excel ячеек до парсинга
        $rawDataBeforeParse=array();
        //после
        $rawDataAfterParse=array();
        $countRows=0;
        $r=array();
        //шаблон
        $acttemplate = array_diff(json_decode($this->_template), array(''));
        foreach ($rawData as $rd)
        {
            //счетчик количества ячеек в строке
            $i=0;
            //счетчик пустых ячеек
            $emptyraws=0;

            foreach ($rd as $key=>$value)
            {
                if (isset($acttemplate))
                {
                    //применение шаблона
                    foreach ($acttemplate as $keytemp=>$valuetemp)
                    {
                        if ($key===$keytemp)
                        {
                            $r[] = array("data"=>$value,"template"=>$valuetemp);
                        }
                    }
                }
                else Yii::app()->user->setFlash('error','Something wrong. =(');
                $i+=1;
            }

            //проверяем количество пустых ячеек в строке
            if (isset($r->data))
            {
                foreach($r->data as $dt)
                    if (strlen($dt)==0)
                        $emptyraws+=1;
            }

            //если пустых строк меньше половины и ячеек в строке больше 3, то строка имеет ценность
            if ($emptyraws<($i/2) and $i>3 and isset($r))
            {
                $rawDataBeforeParse[] = $r;
                $countRows+=1;
                //для отображения в Cgrid необходимо однозначно определяющее строку поле
                //$id = array("id"=>$countRows);
                //$rawData[] = array_merge($id,$r);
            }

            unset($r);

            if ($countRows>=50)
                break;
        }

        $k=0;
        //распознанных строк
        $count=0;
        //занесенных в базу строк
        $countSql=0;
        //массив после распознавания
        $sql=array();

        $brandBefore="";

        //делаем всех правил пользователя
        //$publicRules=Rule::model()->with("conditions","actions")->findAll('userId=:userId and event=:event and weight=:weight', array(':userId'=>1, ':event'=>'parsing', ':weight'=>'public'));
        $rules=Rule::model()->with("conditions","actions")->findAll(array('order'=>'length(depend) desc', 'condition'=>'userId=:userId and event=:event', 'params'=>array(':userId'=>1, ':event'=>'parsing')));

        foreach ($rawDataBeforeParse as $rd)
        {
            foreach ($rd as $dt)
            {
                $rexp=array();
                $template = $dt["template"];
                $str = strtolower($this->getTranstile($dt["data"]));
                $template=TemplateRegexp::model()->regexp($template);

                if ($template->rexp!=null)
                    $rexp[]=$template->rexp;
                else
                {
                    foreach (json_decode($template->parentRexp) as $json)
                        $rexp[]=TemplateRegexp::model()->regexp($json)->rexp;
                }

                //Заполняем массив значениями id, названием и синонимами всех брендов
                foreach (TireSynonym::model()->brands() as $bd)
                {
                    $allBrands->synonym[] = strtolower($this->getTranstile($bd->synonym));
                    $allBrands->title[] = $bd->brands->title;
                    $allBrands->id[] = $bd->brands->id;
                }

                //массив слов паразитов, которые убираем из строки в любом случае
                $wordparasite = array(
                    'ash'=>'', 'sht'=> '', 'tl'=>'', 'vshz'=>'', 'kshz'=>'', 'vorshz'=>'', 'oshz'=>'', 'b/k'=>'', 'avtoshina' => '', 'a/shiny'=>''

                );

                $str=strtr($str,$wordparasite);

                /* если в шаблоне для столбца указано лишь одно значение( к примеру, в столбце только ИН),
                 * то берем значение как есть, не прогоняя через регулярные выражения
                 */
                $this->validator = new CMultyValidate();

                if (count($rexp)==1)
                {
                    for ($i=0;$i<count($rexp);$i++)
                        switch ($rexp[$i])
                        {
                            case "brand": unset($sql); $sql["id"]=$count+1; $sql["brand"]=$this->getBrand($str,$allBrands);  break;
                            case "diametr": if ($this->validator->validateDiametr($str)) $sql["diametr"]=$str; else $sql["diametr"]=""; break;

                            case "width": $sql["width"]=$str; break;
                            case "height": $sql["height"]=$str; break;

                            case "loadIndex": if ($this->validator->validateLoadIndex($str)) $sql["loadIndex"]=$str; else $sql["loadIndex"]=''; break;
                            case "speedIndex": if ($this->validator->validateSpeedIndex($str)) $sql["speedIndex"]=$str; else $sql["speedIndex"]=''; break;

                            case "runflat": $sql["runflat"]=$str; break;

                            //последним находим модель - то что осталось после того как мы все нашли в строке
                            case "model": if (!empty($sql["brand"])) $sql["model"]=trim($str); $sql["rest"]=$str; break;

                            //данные далее идут всегда в отдельном столбце
                            case "xl": $sql["extraLoad"]=$this->getXL($str); break;
                            case "stud": $sql["studdable"]=implode("",$this->getStud($str)); break;

                            case "count":  $sql["count"]=implode("",$this->getCount($str)); break;
                            case "sale": $sql["sale"]=$str; break;
                            case "ym": $sql["ym"]=$str; break;
                            case "available": $sql["available"]=$str; break;
                            case "price": $sql["price"]=$str; break;
                        }
                }
                else
                {
                    for ($i=0;$i<count($rexp);$i++)
                        switch ($rexp[$i])
                        {
                            case "brand": unset($sql); $sql["id"]=$count+1; $sql["brand"]=$this->getBrand($str,$allBrands);  break;
                            case "diametr": $sql["diametr"]=$this->getDiametr($str); break;
                            case "width": $array=$this->getWidthAndHeight($str); $sql["width"]=$array["width"]; $sql["height"]=$array["height"]; break;
                            case "loadIndex": $array=$this->getLoadAndSpeedIndex($str); $sql["loadIndex"]=$array["loadIndex"]; $sql["speedIndex"]=$array["speedIndex"]; break;
                            case "runflat": $sql["runflat"]=implode("",$this->getRunflat($str)); break;

                            //последним находим модель - то что осталось после того как мы все нашли в строке
                            case "model": if (!empty($sql["brand"]))   {
                                //Если текущий бренд не равен предыдущему, то запрашиваем синонимы для текущего бренда

                                if ($sql["brand"]!=$brandBefore)
                                {
                                    unset($allModels);

                                    $brandId=TireBrand::model()->find('title=:title', array(':title'=>$sql["brand"]))->id;

                                    //ищем модели, которые доступны для текущего бренда, а так же синонимы названий моделей
                                    if (isset($brandId))
                                        $bds[$brandId] = TireSynonym::model()->models($brandId);

                                    foreach ($bds[$brandId] as $md)
                                    {
                                        $allModels->synonym[] = " ".strtolower(  $this->getTranstile(($md->synonym) ) )." ";
                                        $allModels->title[] = $md->models->title;
                                    }
                                }

                                $sql["model"]=$this->getModel($str, $allModels);

                                $brandBefore=$sql["brand"];
                            }

                            $sql["rest"]=$str;
                            break;


                            //данные далее идут всегда в отдельном столбце
                            case "xl": $sql["extraLoad"]=$this->getXL($str); break;
                            case "stud": $sql["studdable"]=implode("",$this->getStud($str)); break;

                            case "count": $sql["count"]=implode("",$this->getCount($str)); break;

                            case "sale": $sql["sale"]=$str; break;
                            case "ym": $sql["ym"]=$str; break;
                            case "available": $sql["available"]=$str; break;
                            case "price": $sql["price"]=$str; break;

                        }
                }
            }

            //if ((!empty($sql["brand"]) and (isset($sql["brand"]))) and (!empty($sql["diametr"]) and (isset($sql["diametr"]))) and (!empty($sql["width"]) and (isset($sql["width"]))) and (!empty($sql["height"]) and (isset($sql["height"])))
            //and (!empty($sql["loadIndex"]) and (isset($sql["loadIndex"]))) and (!empty($sql["speedIndex"]) and (isset($sql["speedIndex"]))))

            //изначально строка не преобразуется
            $sql["conversion"]=0;

            if ((!empty($sql["brand"]) and (isset($sql["brand"]))))
            {


                $brandId=TireBrand::model()->find('title=:title', array(':title'=>$sql["brand"]));

                if (!empty($brandId->id) and (!empty($sql["model"]))){

                    $modelId=TireModel::model()->find('title=:title and brandId=:brandId', array(':title'=>$sql["model"],':brandId'=>$brandId->id));

                    if (!empty($modelId->id)){
                        //пытаемся применить правило
                        foreach ($rules as $rule)
                        {
                            unset($applyArr);
                            foreach ($rule->conditions as $rl)
                            {
                                $apply=0;
                                //сначала проверяем все условия с или, так как если оно выполняется, то правило применяется
                                if ($rl->conjunction=="or"){
                                    //значения которые эквивалентны
                                    if ($rl->sign=="=")
                                        switch($rl->column){
                                            case "brand": if ($sql["brand"]==$rl->argument) $apply=1; break;
                                            case "model": if ($sql["model"]==$rl->argument) $apply=1;  break;
                                            case "cost": if ($sql["price"]==$rl->argument) $apply=1;  break;
                                        }
                                    elseif ($rl->sign==">")
                                        if ($sql["price"]>$rl->argument) $apply=1;
                                        elseif ($rl->sign=="<")
                                            if ($sql["price"]<$rl->argument) $apply=1;

                                }elseif ($rl->conjunction=="and"){
                                    //значения которые эквивалентны
                                    if ($rl->sign=="=")
                                        switch($rl->column){
                                            case "brand": if ($sql["brand"]==$rl->argument) $applyArr[]=1; else $applyArr[]=0; break;
                                            case "model": if ($sql["model"]==$rl->argument) $applyArr[]=1; else $applyArr[]=0; break;
                                            case "cost": if ($sql["price"]==$rl->argument) $applyArr[]=1; else $applyArr[]=0; break;
                                        }
                                    elseif ($rl->sign==">")
                                        if ($sql["price"]>$rl->argument) $applyArr[]=1; else $applyArr[]=0;
                                    elseif ($rl->sign=="<")
                                        if ($sql["price"]<$rl->argument) $applyArr[]=1; else $applyArr[]=0;
                                }

                                if (!empty($applyArr))
                                    if (in_array("0",$applyArr))
                                        break;

                                if ($apply==1)
                                    break;
                            }

                            if (!empty($applyArr))
                                if (!(in_array("0",$applyArr)))
                                    $apply=1;

                            if ($apply==1){
                                foreach ($rule->actions as $act)
                                    if ($act->ruleId==$rule->id){
                                        switch($act->column){
                                            case "cost": $some=$act->callback; $sql["price"]=round($this->$some($sql["price"],$act->callbackArgs)); break;
                                        }
                                    }
                                break;
                            }
                        }


                        //заносим в массив распарсенные значения
                        $rawDataAfterParse[]=$sql;
                        $count+=1;


                        //$sizeId=TireSize::model()->find('brandId=:brandId and modelId=:brandId and width=:width and height=:height and diametr=:diametr and loadIndex=:loadIndex and speedIndex=:speedIndex',
                        //    array(':brandId'=>$brandId,':modelId'=>1,'width'=>$dt["width"],'height'=>$dt["height"],'diametr'=>$dt["diametr"],'loadIndex'=>$dt["loadIndex"],'speedIndex'=>$dt["speedIndex"]));

                        //ищем типоразмер в таблице

                        $seach=$sql;
                        unset($seach["id"]);
                        unset($seach["brand"]);
                        unset($seach["model"]);
                        unset($seach["runflat"]);
                        unset($seach["count"]);
                        unset($seach["price"]);
                        unset($seach["rest"]);
                        unset($seach["conversion"]);

                        $seach["brandId"]=$brandId->id;
                        $seach["modelId"]=$modelId->id;

                        $sizeId=TireSize::model()->findByAttributes($seach);

                        //если такого типоразмера не найдено в таблице index, то отсылаем письмо, чтобы менеджер вручную добавил, в случае необходимости.
                        if (!empty($sizeId))
                        {
                            //ищем строку с такими пользователем, поставщиком и типоразмером
                            $priceTable=TirePrice::model()->find('sizeId=:sizeId and userId=:userId', array(':sizeId'=>$sizeId->id,':userId'=>1));
                            if (!empty($priceTable))
                            {
                                $priceTable->cost=$sql["price"];
                                $priceTable->stockLevel=$sql["count"];
                                if ($priceTable->save())
                                    $countSql+=1;
                                else echo "Something wrong";
                            }
                            else //$this->mail($data);
                            {
                                unset($priceTable);
                                $priceTable= new TirePrice;
                                $priceTable->sizeId=$sizeId->id;
                                $priceTable->userId=1;
                                $priceTable->cost=$sql["price"];
                                if (!empty($dt["count"]))
                                    $priceTable->stockLevel=$sql["count"];
                                $priceTable->provider=1;
                                if ($priceTable->save())
                                    $countSql+=1;
                                else
                                {
                                    $sql["pure"]=$pure[$k];
                                    $sql["error"]="Something wrong with saving into database!";
                                    $this->email[]=$sql;
                                }

                            }
                        }
                        else //$this->mail($data);
                        {
                            $sql["pure"]=$pure[$k];
                            $sql["error"]="Didn't find accordance in Size's table!";
                            $this->unParsed[]=$sql;
                        }

                    }
                    else //$this->mail($data);
                    {
                        $sql["pure"]=$pure[$k];
                        $sql["error"]="Didn't find accordance in Model's table!";
                        $this->unParsed[]=$sql;
                    }
                }
                else
                {
                    $sql["pure"]=$pure[$k];
                    $sql["error"]="Didn't find accordance in Model's table!";
                    $this->unParsed[]=$sql;
                }
            }
            else
            {
                $sql["pure"]=$pure[$k];
                $sql["error"]="Didn't find accordance in Brand's table!";
                $this->unParsed[]=$sql;
            }
            $k+=1;
        }

        $this->reader->statistics->allParsed=$count;
        $this->reader->statistics->allSql=$countSql;

        return $rawDataAfterParse;
	}

    function plus($data,$arg) {
        return strpos($arg,'%')!==false ? $data*(1+0.01*(float)$arg) : $data+$arg;
    }

    function minus($data,$arg) {
        return strpos($arg,'%')!==false ? $data*(1-0.01*(float)$arg) : $data-$arg;
    }

    function stat(){
        return ($this->reader->statistics);
    }

    function getBrand(&$str,$allBrands){
        //счетчик положения курсора в строке
        $i=0;
        // В первую очередь ищем бренд, если его нет, то дальше обрабатывать строку смысла нет
        while ($i<sizeof($allBrands->synonym) && strpos($str, $allBrands->synonym[$i]) === false) $i++;
        //если нашли заносим в переменную и переходим к следующей строке
        if ($i<sizeof($allBrands->synonym))
        {
            $regularBrand = $allBrands->synonym[$i];
            $str = preg_replace(".$regularBrand.", "", $str);
            $brand=$allBrands->title[$i];
        }
        return(isset($brand)) ? "$brand" : "";
    }



    //поиск модели по синонимам
    function getModel(&$str,$allModels){
        if (!empty($allModels->synonym))
        {
            $i=0;
            $find=false;


            foreach ($allModels->synonym as $aM)
            {
                if (trim($aM)==trim($str)){
                    $find=true;
                    break;
                }
                else $i++;
            }

            if ($find)
                return($allModels->title[$i]);
            else  return("");
        }
        return("");
    }

    function getDiametr(&$str){
        //находим то что похоже на диаметр
        $regularDiametr="/ r\s?[0-9]{2}c? | [0-9]{2}r |r[0-9]{2}c/";

        preg_match_all($regularDiametr,$str, $data);

        $diametr='';

        //пока значение ИН не соответствует условию валидации ищем в строке
        foreach ($data as $dta)
        {
            foreach ($dta as $dt)
            {
                if  (strlen($dt)>0)
                {
                    if ($this->validator->validateDiametr(trim($dt)))
                    {
                        $diametr=$dt;
                        $str = str_replace($diametr, "", $str);
                        break;
                    }
                }
            }
        }

        //если ничего не нашли, то попробуем найти с ошибками
        if (strlen($diametr)<=0)
        {
            $regularDiametr="/r[0-9]{2}|[0-9]{2}r/";

            preg_match_all($regularDiametr,$str, $data);

            $diametr='';
            //пока значение ИН не соответствует условию валидации ищем в строке
            foreach ($data as $dta)
            {
                foreach ($dta as $dt)
                {
                    if  (strlen($dt)>0)
                    {
                        if ($this->validator->validateDiametr(trim($dt)))
                        {
                            $diametr=$dt;
                            $str = str_replace($diametr, "", $str);
                            break;

                        }
                    }
                }
            }
        }

        $diametr = str_replace("r", "", $diametr);
        return trim($diametr);
    }

    function getWidthAndHeight(&$str){
        // Находим то что похоже на ширину
        $regularWidth="/[0-9]{2,3}\/[0-9]{2,3}/";
        preg_match($regularWidth,$str,$width);
        $str = preg_replace($regularWidth, "", $str, 1);

        //находим то что похоже на высоту
        $regularHeight="/\/[0-9]{2,3}/";
        $width=implode("",$width);
        preg_match($regularHeight,$width,$height);
        $width = preg_replace($regularHeight, "", $width, 1);
        $height = str_replace("/", "", $height);
        $height=implode("",$height);
        return (array("height"=>$height,"width"=>$width));
    }

    function getLoadAndSpeedIndex(&$str){
        // Находим то что похоже на ИН (число/число)
        $regularLoadIndex="/[0-9]{2,3}[a-z]|[0-9]{2,3}\/[0-9]{2,3}[a-z]| [0-9]{2,3} [a-z] |[0-9]{2,3}\/[0-9]{2,3} [a-z]/";
        $regularSpeedIndex="/[a-z]/";

        $speedIndex="";
        $loadIndex="";

        preg_match_all($regularLoadIndex,$str,$data);

        foreach ($data as $dta)
        {
            foreach ($dta as $dt)
            {
                if  (strlen($dt)>0)
                {
                    preg_match($regularSpeedIndex,$dt,$tempSpeedIndex);
                    $tempLoadIndex = preg_replace($regularSpeedIndex, "", $dt, 1);
                    $tempSpeedIndex=implode("",$tempSpeedIndex);
                    if ($this->validator->validateLoadIndex($tempLoadIndex) and $this->validator->validateSpeedIndex($tempSpeedIndex))
                    {
                        $loadIndex=$tempLoadIndex;
                        $speedIndex=$tempSpeedIndex;
                        $str = str_replace($dt, "", $str);
                        break;
                    }
                }
            }
        }

        return (array("loadIndex"=>trim($loadIndex),"speedIndex"=>trim($speedIndex)));
    }


    function getSpeedIndex(&$loadIndex){
        $regularSpeedIndex="/[a-z]/";
        preg_match($regularSpeedIndex,$loadIndex,$speedIndex);
        $loadIndex = preg_replace($regularSpeedIndex, "", $loadIndex, 1);
    }

    function getXL(&$str){
        //находим нечто похожее на XL
        // | xl$|^xl |extra load|extraload
        $regularXL="/ xl| extraload| extra load/";
        preg_match($regularXL,$str, $xl);
        $str = preg_replace($regularXL, "", $str);
        return (implode("",$xl));
    }



    function getStud(&$str){
        //находим нечто похожее на шипованную резину
        $regularStud="/ship/";
        preg_match($regularStud,$str, $stud);
        $str = preg_replace($regularStud, "", $str);
        return ($stud);
    }

    function getRunflat(&$str){
        //находим нечто похожее на шипованную резину
        $regularRunflat="/(Run Flat|RunFlat|[ ]SSR[ ]|[ ]SSR$|^SSR[ ]|[ ]DSST[ ]|[ ]DSST$|^DSST[ ]|[ ]ROF[ ]|[ ]ROF$|^ROF[ ]|[ ]RFT[ ]|[ ]RFT$|^RFT[ ]|[ ]XRP[ ]|[ ]XRP$|^XRP[ ]|[ ]ZP[ ]|[ ]ZP$|^ZP[ ]|[ ]EMT[ ]|[ ]EMT$|^EMT[ ])/";
        preg_match($regularRunflat,$str, $runflat);
        $str = preg_replace($regularRunflat, "", $str);
        return ($runflat);
    }


    function getCount(&$str){
        $regularCount="/[0-9]{1,4}/";
        preg_match($regularCount,$str, $count);
        $str = preg_replace($regularCount, "", $str);
        return ($count);
    }


    function getPrice(&$str){
        return(strstr(".",",",$str));
    }



    function getTranstile($data){
        $lang2tr = array(
            'й'=>'j','ц'=>'c','у'=>'u','к'=>'k','е'=>'e','н'=>'n','г'=>'g','ш'=>'sh',
            'щ'=>'sh','з'=>'z','х'=>'h','ъ'=>'','ф'=>'f','ы'=>'y','в'=>'v','а'=>'a',
            'п'=>'p','р'=>'r','о'=>'o','л'=>'l','д'=>'d','ж'=>'zh','э'=>'e','я'=>'ja',
            'ч'=>'ch','с'=>'s','м'=>'m','и'=>'i','т'=>'t','ь'=>'','б'=>'b','ю'=>'ju','ё'=>'e','и'=>'i',

            'Й'=>'J','Ц'=>'C','У'=>'U','К'=>'K','Е'=>'E','Н'=>'N','Г'=>'G','Ш'=>'SH',
            'Щ'=>'SH','З'=>'Z','Х'=>'H','Ъ'=>'','Ф'=>'F','Ы'=>'Y','В'=>'V','А'=>'A',
            'П'=>'P','Р'=>'R','О'=>'O','Л'=>'L','Д'=>'D','Ж'=>'ZH','Э'=>'E','Я'=>'JA',
            'Ч'=>'CH','С'=>'S','М'=>'M','И'=>'I','Т'=>'T','Ь'=>'','Б'=>'B','Ю'=>'JU','Ё'=>'E','И'=>'I',

            '-'=>'', '_'=>'', '('=>'', ')'=>'', '*'=>''
        );
        return(strtr($data,$lang2tr));
    }
}