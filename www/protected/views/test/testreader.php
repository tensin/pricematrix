<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $arrayDataProvider,
    'columns'=>getPriceColumns($arrayDataProvider),
));
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