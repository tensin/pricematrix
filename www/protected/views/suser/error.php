<?php

$this->menu=array(
	array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
	array('label'=>'Мои файлы', 'url'=>array('files')),
	array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
	//array('label'=>'Create TireSize', 'url'=>array('create')),
);
?>


<?php if(Yii::app()->user->hasFlash('error')) ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
