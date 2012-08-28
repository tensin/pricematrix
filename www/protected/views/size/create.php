<?php
$this->breadcrumbs=array(
	'Tire Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TireSize', 'url'=>array('index')),
	array('label'=>'Manage TireSize', 'url'=>array('admin')),
);
?>

<h1>Create TireSize</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>