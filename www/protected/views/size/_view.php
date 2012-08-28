<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brandId')); ?>:</b>
	<?php echo CHtml::encode($data->brandId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modelId')); ?>:</b>
	<?php echo CHtml::encode($data->modelId); ?>
	<br />
	
	<b>Name:</b>
	<?php echo CHtml::encode($data->brands->title)." ".CHtml::encode($data->model->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
	<?php echo CHtml::encode($data->width); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
	<?php echo CHtml::encode($data->height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diameter')); ?>:</b>
	<?php echo CHtml::encode($data->diameter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('loadIndex')); ?>:</b>
	<?php echo CHtml::encode($data->loadIndex); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('speedIndex')); ?>:</b>
	<?php echo CHtml::encode($data->speedIndex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('runflat')); ?>:</b>
	<?php echo CHtml::encode($data->runflat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extraLoad')); ?>:</b>
	<?php echo CHtml::encode($data->extraLoad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('studdable')); ?>:</b>
	<?php echo CHtml::encode($data->studdable); ?>
	<br />

</div>