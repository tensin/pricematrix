<?php

$this->menu=array(
	array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
	array('label'=>'Мои файлы', 'url'=>array('list')),
	array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
	//array('label'=>'Create TireSize', 'url'=>array('create')),
);
?>

<h1>Add price list</h1>


<?php 
$t1 = $this->renderPartial('_form', compact('model', 'templates'), $this);

function gfg()
{
return '132258';
}

$model->scenario = 'createByFile';

$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'From Harddisk', 'content'=>$this->renderPartial('_form', compact('model', 'templates'), $this), 'active'=>true),
        //array('label'=>'From Web', 'content'=>$form->textFieldRow($model, 'url', array('hint'=>'Enter file url'))),
    ),
)); ?>


<?php //echo $this->renderPartial('_form', compact('model', 'templates')); ?>

