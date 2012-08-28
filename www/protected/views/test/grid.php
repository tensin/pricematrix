<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tire-size-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		'id',
		'brandId',
		
		array(
			'name' => 'Brand title',
			'value' => '$data->model->brand->title',
		),
		array(
			'name' => 'Brand image',
			'value' => '$data->model->brand->image',
		),
		array(
			'name' => 'Brand image on fly',
			'value' => '$data->model->brand->imageUrl',
		),
		array(
			'name' => 'Model title',
			'value' => '$data->model->title',
		),
		
		'modelId',
		'width',
		'height',
		'diameter',
		'tireCode',
		/*
		'loadIndex',
		'speedIndex',
		'runflat',
		'extraLoad',
		'studdable',
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
