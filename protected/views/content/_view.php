<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_public')); ?>:</b>
	<?php echo CHtml::encode($data->date_public); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('stop')); ?>:</b>
	<?php echo CHtml::encode($data->stop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_parse')); ?>:</b>
	<?php echo CHtml::encode($data->date_parse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_id')); ?>:</b>
	<?php echo CHtml::encode($data->site_id); ?>
	<br />


</div>