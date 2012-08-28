<?php
$this->breadcrumbs=array(
	'Tire Synonyms'=>array('index'),
	'Manage',
);

if ($type=='brand')
    $this->menu=array(
        array('label'=>'List TireSynonym', 'url'=>array('index')),
        array('label'=>'Create TireSynonym', 'url'=>array('create')),
        array('label'=>'Manage Models Synonyms', 'url'=>array('adminModels')),
    );

if ($type=='model')
    $this->menu=array(
        array('label'=>'List TireSynonym', 'url'=>array('index')),
        array('label'=>'Create TireSynonym', 'url'=>array('create')),
        array('label'=>'Manage Brands Synonyms', 'url'=>array('adminBrands')),
    );


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tire-synonym-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tire Synonyms</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array('model'=>$model)); ?>
</div><!-- search-form -->

<?php

if ($type=='brand')
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'tire-synonym-grid',
        'dataProvider'=>$model->searchBrands(),
        'filter'=>$model,
        'columns'=>array(
            'id',
            'parentId',
            'synonym',
            'type',
            array( 'name'=>'title_search', 'value'=>'$data->brands->title' ),
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    ));

if ($type=='model')
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'tire-synonym-grid',
        'dataProvider'=>$model->searchModels(),
        'filter'=>$model,
        'columns'=>array(
            'id',
            'parentId',
            'synonym',
            'type',
            array( 'name'=>'title_search', 'value'=>'$data->models->title' ),
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    ));

?>
