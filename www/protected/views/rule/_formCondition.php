<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'condition-form',
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
        echo CHtml::dropDownList("column", $model, array('brand'=>'brand','model'=>'model','cost'=>'cost'));
        ?>
        <?php echo $form->error($model,'column'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sign'); ?>
        <?php
        echo CHtml::dropDownList("sign", $model, array('>'=>'>','<'=>'<','='=>'='));
        ?>
        <?php echo $form->error($model,'sign'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'argument'); ?>
        <?php echo $form->textField($model,'argument',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'argument'); ?>
    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->