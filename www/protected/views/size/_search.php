<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'brandId'); ?>
		<?php echo $form->textField($model,'brandId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modelId'); ?>
		<?php echo $form->textField($model,'modelId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diameter'); ?>
		<?php echo $form->textField($model,'diameter',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'loadIndex'); ?>
		<?php echo $form->textField($model,'loadIndex',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'speedIndex'); ?>
		<?php echo $form->textField($model,'speedIndex',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'runflat'); ?>
		<?php echo $form->textField($model,'runflat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extraLoad'); ?>
		<?php echo $form->textField($model,'extraLoad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'studdable'); ?>
		<?php echo $form->textField($model,'studdable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->