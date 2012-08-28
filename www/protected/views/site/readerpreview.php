<?php //$this->pageTitle=Yii::app()->name;
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $arrayDataProvider,
	'columns'=>array(
		'id',
		'col1', 'col2',
		array(
			'name' => CHtml::dropDownList('data[col1]', 'select1', array('test'=>'test1', 'test1'=>'test2'), array('prompt' => '--none--')), //'<input type="text" />',
			'value' => '$data["col3"]',
		),
	)
));

?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->fileField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>	

	<div class="row buttons">
		<?php echo CHtml::submitButton('UPLOAD'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
