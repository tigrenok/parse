<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('stop')); ?>:</b>
	<?php echo CHtml::encode($data->stop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('law_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->law_type_id); ?>
	<br />
	<br />


</div>