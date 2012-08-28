<?php
$this->breadcrumbs=array(
	'Rules',
);

$this->menu=array(
	array('label'=>'Create Rule', 'url'=>array('createRule')),
);
?>

<h1>Rules</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'rule-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'userId',
        'title',
        'event',
        'depend',
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("/Rule/admin", array("id" => $data->id))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("/Rule/delete", array("id" => $data->id, "type"=>"rule"))',
            'updateButtonUrl'=>'Yii::app()->createUrl("/Rule/update", array("id" => $data->id, "type"=>"rule"))',
        ),
    ),
)); ?>
