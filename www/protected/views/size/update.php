<?php
$this->breadcrumbs=array(
	'Tire Sizes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TireSize', 'url'=>array('index')),
	array('label'=>'Create TireSize', 'url'=>array('create')),
	array('label'=>'View TireSize', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TireSize', 'url'=>array('admin')),
);
?>

<h1>Update TireSize <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>