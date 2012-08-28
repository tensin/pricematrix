<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rule-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userId'); ?>
		<?php echo $form->textField($model,'userId'); ?>
		<?php echo $form->error($model,'userId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'event'); ?>
        <?php
        echo CHtml::dropDownList("event", $model, array('parsing'=>'parsing'));
        ?>
        <?php echo $form->error($model,'event'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'depend'); ?>
        <?php
        echo CHtml::dropDownList("depend", $model, array('public'=>'public', 'private'=>'private'));
        ?>
        <?php echo $form->error($model,'depend'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->