<?php
$this->breadcrumbs=array(
	'Rules'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'List All Rules', 'url'=>array('index')),
	array('label'=>'Create Rule', 'url'=>array('create')),
	array('label'=>'View Rule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Rule', 'url'=>array('admin')),
);
?>
<?php switch($type){
    case "rule": echo "<h1>Create Rule</h1>"; echo $this->renderPartial('_formRule', array('model'=>$model)); break;
    case "action": echo "<h1>Create action</h1>"; echo $this->renderPartial('_formAction', array('model'=>$model,'rule'=>$rule)); break;
    case "condition": echo "<h1>Create condition</h1>"; echo $this->renderPartial('_formCondition', array('model'=>$model,'rule'=>$rule)); break;
}
?>