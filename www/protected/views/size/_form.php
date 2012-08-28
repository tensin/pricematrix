<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tire-size-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'brandId'); ?>
		<?php echo $form->textField($model,'brandId'); ?>
		<?php echo $form->error($model,'brandId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modelId'); ?>
		<?php echo $form->textField($model,'modelId'); ?>
		<?php echo $form->error($model,'modelId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diameter'); ?>
		<?php echo $form->textField($model,'diameter',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'diameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'loadIndex'); ?>
		<?php echo $form->textField($model,'loadIndex',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'loadIndex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'speedIndex'); ?>
		<?php echo $form->textField($model,'speedIndex',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'speedIndex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'runflat'); ?>
		<?php echo $form->textField($model,'runflat'); ?>
		<?php echo $form->error($model,'runflat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extraLoad'); ?>
		<?php echo $form->textField($model,'extraLoad'); ?>
		<?php echo $form->error($model,'extraLoad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'studdable'); ?>
		<?php echo $form->textField($model,'studdable'); ?>
		<?php echo $form->error($model,'studdable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->