<?php
$this->breadcrumbs=array(
	'Tire Synonyms',
);

$this->menu=array(
	array('label'=>'Create TireSynonym', 'url'=>array('create')),
    array('label'=>'Manage Brands Synonyms', 'url'=>array('adminBrands')),
    array('label'=>'Manage Models Synonyms', 'url'=>array('adminModels')),
);
?>

<h1>Tire Synonyms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
