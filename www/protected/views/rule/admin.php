<?php
$this->breadcrumbs=array(
	'Rules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List All Rules', 'url'=>array('index')),
	array('label'=>'Создать правило', 'url'=>array('createRule')),
    array('label'=>'Создать действие', 'url'=>array('createAction')),
    array('label'=>'Создать условие', 'url'=>array('createCondition')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rule-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Rules</h1>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rule-grid',
	'dataProvider'=>$model->searchById($id),
	'filter'=>$model,
	'columns'=>array(
		'userId',
		'title',
		'event',
		'depend',
		array(
			'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/Rule/view", array("id" => $data->id, "type"=>"rule"))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("/Rule/delete", array("id" => $data->id, "type"=>"rule"))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/Rule/update", array("id" => $data->id, "type"=>"rule"))',
		),
	),
));

echo "<h5>Действия</h5>";
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'action-grid',
    'dataProvider'=>$action->searchByRuleId($id),
    'filter'=>$action,
    'columns'=>array(
        'column',
        'callback',
        'callbackArgs',
        'weight',
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/Rule/view", array("id" => $data->id, "type"=>"action"))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("/Rule/delete", array("id" => $data->id, "type"=>"action"))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/Rule/update", array("id" => $data->id, "type"=>"action"))',
        ),
    ),
));

echo "<h5>Условия</h5>";
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'condition-grid',
    'dataProvider'=>$condition->searchByRuleId($id),
    'filter'=>$condition,
    'columns'=>array(
        'column',
        'sign',
        'argument',
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/Rule/view", array("id" => $data->id, "type"=>"condition"))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("/Rule/delete", array("id" => $data->id, "type"=>"condition"))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/Rule/update", array("id" => $data->id, "type"=>"condition"))',
        ),
    ),
));

?>
