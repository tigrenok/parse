<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-pars-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'law_id'); ?>
		<?php echo $form->dropDownList($model, 'law_id', Comp::getlistv('Law', 'id', 'description'));?>
		<?php echo $form->error($model,'law_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coding_id'); ?>      
		<?php echo $form->dropDownList($model, 'coding_id', Comp::getlist('Coding', 'id', 'name'));?>
		<?php echo $form->error($model,'coding_id'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'child_id'); ?>      
		<?php echo $form->dropDownList($model, 'child_id', Comp::getlistv('SitePars', 'id', 'name'));?>
		<?php echo $form->error($model,'child_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->