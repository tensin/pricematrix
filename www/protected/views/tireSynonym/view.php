<?php
$this->breadcrumbs=array(
	'Tire Synonyms'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TireSynonym', 'url'=>array('index')),
	array('label'=>'Create TireSynonym', 'url'=>array('create')),
	array('label'=>'Update TireSynonym', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TireSynonym', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage Brands Synonyms', 'url'=>array('adminBrands')),
    array('label'=>'Manage Models Synonyms', 'url'=>array('adminModels')),
);
?>

<h1>View TireSynonym #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parentId',
		'synonym',
		'type',
	),
)); ?>
