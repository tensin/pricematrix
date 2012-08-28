<?php

$this->menu=array(
    array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
    array('label'=>'Мои файлы', 'url'=>array('files')),
    array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
    //array('label'=>'Create TireSize', 'url'=>array('create')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => '#',
			'value' => '$data->supplier->id',
		),
		array(
			'name' => 'title',
			'value' => '$data->supplier->title',
		),
		//'filename'
	),
)); ?>