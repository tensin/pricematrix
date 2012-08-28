<?php
$this->breadcrumbs=array(
	'Tire Sizes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TireSize', 'url'=>array('index')),
	array('label'=>'Create TireSize', 'url'=>array('create')),
	array('label'=>'Update TireSize', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TireSize', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TireSize', 'url'=>array('admin')),
);
?>

<h1>View TireSize #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'brandId',
		'modelId',
		'width',
		'height',
		'diameter',
		'loadIndex',
		'speedIndex',
		'runflat',
		'extraLoad',
		'studdable',
	),
)); ?>
