<?php

$this->menu=array(
	array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
	array('label'=>'Мои файлы', 'url'=>array('files')),
	array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
	//array('label'=>'Create TireSize', 'url'=>array('create')),
);
?>

<h1>Add new user file</h1>

<?php if(Yii::app()->user->hasFlash('user-file-added')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('user-file-added'); ?>
</div>

<?php else: ?>

<!--<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>-->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-file-add-form',
	//'enableClientValidation'=>true,
	/*'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),*/
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'templateId'); ?>
		<?php echo $form->dropDownList($model,'templateId', $templates, array('prompt' => 'Создать новый')); ?>
		<?php echo $form->error($model,'templateId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->fileField($model,'filename'); ?>
		<?php echo $form->error($model,'filename'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>