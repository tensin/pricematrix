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
        <?php echo $form->label($model,'title_search'); ?>
        <?php echo $form->textField($model,'title_search',array('size'=>30,'maxlength'=>30)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'synonym'); ?>
		<?php echo $form->textField($model,'synonym',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<!--<div class="row">
		<?php //echo $form->label($model,'type'); ?>
		<?php //echo $form->textField($model,'type',array('size'=>5,'maxlength'=>5)); ?>
	</div>
	 <div class="row">
		<?php //echo $form->label($model,'ID parent'); ?>
		<?php //echo $form->textField($model,'parentId'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->