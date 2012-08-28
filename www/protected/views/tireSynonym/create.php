<?php
$this->breadcrumbs=array(
	'Tire Synonyms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TireSynonym', 'url'=>array('index')),
	array('label'=>'Manage Brands Synonyms', 'url'=>array('adminBrands')),
    array('label'=>'Manage Models Synonyms', 'url'=>array('adminModels')),
);
?>

<h1>Create TireSynonym</h1>


<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'tire-synonym-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <?
    echo CHtml::dropDownList("brands",$brands, CHtml::listData($brands,
            'id', 'title'),
        array(
            'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('TireSynonym/FindModels'), //url to call.
                'update'=>'#models', //selector to update
            )));

    echo CHtml::dropDownList('models','', array());
    ?>

    <div class="row">
        <?php echo $form->labelEx($model,'synonym'); ?>
        <?php echo $form->textField($model,'synonym',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($model,'synonym'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->