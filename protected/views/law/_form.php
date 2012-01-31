<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'law-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Обязательные поля <span class="required">*</span></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
                <?php echo CHtml::dropDownList('Law[type]',$model->type, array('list'=>'list','one'=>'one')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'list_law'); ?>
		<?php echo $form->textField($model,'list_law',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'list_law'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title_law'); ?>
		<?php echo $form->textField($model,'title_law',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'title_law'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_law'); ?>
		<?php echo $form->textField($model,'date_law',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'date_law'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'autor_law'); ?>
		<?php echo $form->textField($model,'autor_law',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'autor_law'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content_law'); ?>
		<?php echo $form->textField($model,'content_law',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'content_law'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_law'); ?>
		<?php echo $form->textField($model,'img_law',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'img_law'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->