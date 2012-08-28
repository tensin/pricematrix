<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'action-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
    <?php echo $form->labelEx($model,'Rule Title'); ?>
    <?php
    echo CHtml::dropDownList("rule",$rule, CHtml::listData($rule,
            'id', 'title')
       );
    ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'column'); ?>
        <?php
        echo CHtml::dropDownList("column", $model, array('cost'=>'cost'));
        ?>
        <?php echo $form->error($model,'column'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'callback'); ?>
        <?php
        echo CHtml::dropDownList("callback", $model, array('plus'=>'plus','minus'=>'minus'));
        ?>
		<?php echo $form->error($model,'callback'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'callbackArgs'); ?>
        <?php echo $form->textField($model,'callbackArgs',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'callbackArgs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
        <?php
        echo CHtml::dropDownList("weight", $model, array('1'=>'1','2'=>'2','3'=>'3'));
        ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->