<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
       
	<b><?php echo CHtml::encode($data->getAttributeLabel('coding')); ?>:</b>
	<?php echo CHtml::encode($data->coding); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('law_id')); ?>:</b>
	<?php echo CHtml::encode($data->law->url); ?>
	<br />


</div>