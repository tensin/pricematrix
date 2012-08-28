<?php

$this->menu=array(
    array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
    array('label'=>'Мои файлы', 'url'=>array('file/list')),
    array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
    //array('label'=>'Create TireSize', 'url'=>array('create')),
);


$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        'id', 
		/*'userId', */
		'templateId', 
		'mime', 
		'created',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
)); 

 ?>