<?php
$this->breadcrumbs=array(
	'Tire Synonyms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TireSynonym', 'url'=>array('index')),
	array('label'=>'Create TireSynonym', 'url'=>array('create')),
	array('label'=>'View TireSynonym', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage Brands Synonyms', 'url'=>array('adminBrands')),
    array('label'=>'Manage Models Synonyms', 'url'=>array('adminModels')),
);
?>

<h1>Update TireSynonym <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>