<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'law-field-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'law_id'); ?>
		<?php echo $form->dropDownList($model, 'law_id', Comp::getlist('Law', 'id', 'description'));?>
		<?php echo $form->error($model,'law_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type', Comp::getlist('LawFieldType', 'id', 'value'));?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fn'); ?>
		<?php echo $form->textArea($model,'fn',array('rows'=>6, 'cols'=>30)); ?>
		<?php echo $form->error($model,'fn'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->