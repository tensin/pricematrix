<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
	'inlineErrors'=>false,
    'htmlOptions'=>array(
		//'class'=>'well',
		'enctype' => 'multipart/form-data'
	),
)); ?>

<?php echo $form->dropDownListRow($model, 'templateId', $templates, array('prompt' => 'Create new one')); ?>

<?php if ($model->scenario == 'createByFile'): ?>
	<?php echo $form->fileFieldRow($model, 'file', array('hint'=>'Choose required file')); ?>
	<?php echo $form->hiddenField($model, 'uploadType', array('value'=>'createByFile')); ?>
<?php endif; ?>

<?php if ($model->scenario == 'createByUrl'): ?>
	<?php echo $form->textFieldRow($model, 'url', array('hint'=>'Enter file url')); ?>
	<?php echo $form->hiddenField($model, 'uploadType', array('value'=>'createByUrl')); ?>
<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'icon'=>'ok white', 'type'=>'primary', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>
