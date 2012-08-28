<?php
$this->menu=array(
    array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
    array('label'=>'Мои файлы', 'url'=>array('files')),
    array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
    //array('label'=>'Create TireSize', 'url'=>array('create')),
);

echo CHtml::beginForm();

echo '<div class="action">';
echo CHtml::submitButton('Экспорт в csv');
//echo "<br>";
//echo CHtml::submitButton('Экспорт в sql');
echo "</div>";

echo "<br>Всего строк в файле:".$stat->allExist ;
echo "<br>Прочитано:".$stat->allRead ;
echo "<br>Распознано:".$stat->allParsed;
echo "<br>Обновлено в базе: ".$stat->allSql;
echo "<br>".($stat->allParsed/$stat->allExist)*100;
echo "% от общего количества";


echo CHtml::endForm();

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $arrayDataProvider,
));

?>
