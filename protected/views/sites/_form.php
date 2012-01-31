<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sites-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Обязательные поля <span class="required">*</span></p>

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
                <?php echo CHtml::dropDownList('Sites[law_id]',(int)$model->law_id, $law); ?>
		<?php echo $form->error($model,'law'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'coding'); ?>
		<?php echo $form->textField($model,'coding',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'coding'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
