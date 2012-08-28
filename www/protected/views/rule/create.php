<?php
$this->breadcrumbs=array(
	'Rules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Rule', 'url'=>array('index')),
	array('label'=>'Manage Rule', 'url'=>array('admin')),
);

switch($type){
    case "rule": echo "<h1>Create Rule</h1>"; echo $this->renderPartial('_formRule', array('model'=>$model)); break;
    case "action": echo "<h1>Create action</h1>"; echo $this->renderPartial('_formAction', array('model'=>$model,'rule'=>$rule)); break;
    case "condition": echo "<h1>Create condition</h1>"; echo $this->renderPartial('_formCondition', array('model'=>$model,'rule'=>$rule)); break;
}
 ?>