<?php

$this->menu=array(
    array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
    array('label'=>'Мои файлы', 'url'=>array('files')),
    array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
    //array('label'=>'Create TireSize', 'url'=>array('create')),
);

echo CHtml::beginForm();
    //если шаблон уже задан, а не создается
    if ((isset($arrayTemplate)) and (!empty($arrayTemplate)))
    {
        echo '<div class="action">';
        echo CHtml::submitButton('Применить шаблон');
        echo "</div>";
    }
    else
    {
        echo "Введите имя нового шаблона:<br>";
        echo CHtml::textField('name', '',
            array('id'=>'idTextField',
                'width'=>100,
                'maxlength'=>30));
        echo '<div class="action">';
        echo CHtml::submitButton('Сохранить шаблон');
        echo "</div>";
    }

function getPriceColumns($dataProvider,$arrTemplate)
{
    $columns = array();

    //если шаблон задан, а не создается
    if ((isset($arrTemplate)) and (!empty($arrTemplate)))
    {
        foreach($arrTemplate as $arrTemp)
        {
            if ($arrTemp!=null)
                $name[]=TemplateRegexp::model()->findbyPk($arrTemp)->title;
            else $name[]="empty";

        }

        foreach($dataProvider->getData() as $row) {
            foreach($row as $idx => $column)
            {
                if ($idx===0)
                    if ($name[$idx]!="empty")
                    $columns[] = array(
                        'name' => $name[0],
                        'value' => '$data["0"]',
                    );
                if ($idx!="id")
                {
                    if ($name[$idx]!="empty")
                    {
                        $columns[] = array(
                            'name' => $name[$idx],
                            'value' => '$data["'.$idx.'"]',
                        );
                    }

                }
            }
            break;
        }
    }
    else
    {
        $criteria=new CDbCriteria();
        $criteria->order = 'LENGTH(title) DESC';
        foreach($dataProvider->getData() as $row) {
            foreach($row as $idx => $column)
            {
                if ($idx===0)
                    $columns[] = array(
                        'name' => CHtml::dropDownList('data[0]', 'select[0]', CHtml::listData(TemplateRegexp::model()->findAll($criteria), 'id', 'title'), array('prompt' => '--empty--')),
                        'value' => '$data["0"]',
                    );
                if ($idx!="id")
                {
                    $columns[] = array(
                        'name' => CHtml::dropDownList('data['.$idx.']', 'select['.$idx.']', CHtml::listData(TemplateRegexp::model()->findAll($criteria), 'id', 'title'), array('prompt' => '--empty--')),
                        'value' => '$data["'.$idx.'"]',
                    );
                }
            }
            break;
        }
    }
    return $columns;
}

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $arrayDataProvider,
    'columns'=>getPriceColumns($arrayDataProvider,$arrayTemplate),
));

echo CHtml::endForm();
 /*
  *
  *
  * 'columns'=>array(
        array(
            'name' => CHtml::dropDownList('data[col1]', 'select1', array('test'=>'test1', 'test1'=>'test2'), array('prompt' => '--none--')),
            'value' => '$data["col1"]',
        ),
        array(
            'name' => CHtml::dropDownList('data[col2]', 'select2', array('test'=>'test1', 'test1'=>'test2'), array('prompt' => '--none--')),
            'value' => '$data["col2"]',
        ),
        array(
            'name' => CHtml::dropDownList('data[col3]', 'select3', array('test'=>'test1', 'test1'=>'test2'), array('prompt' => '--none--')),
            'value' => '$data["col3"]',
        ),
  */