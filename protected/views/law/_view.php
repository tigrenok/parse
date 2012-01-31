<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list_law')); ?>:</b>
	<?php echo CHtml::encode($data->list_law); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_law')); ?>:</b>
	<?php echo CHtml::encode($data->title_law); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_law')); ?>:</b>
	<?php echo CHtml::encode($data->date_law); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('autor_law')); ?>:</b>
	<?php echo CHtml::encode($data->autor_law); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_law')); ?>:</b>
	<?php echo CHtml::encode($data->content_law); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_law')); ?>:</b>
	<?php echo CHtml::encode($data->img_law); ?>
	<br />

</div>