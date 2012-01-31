<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parse-form',
	'enableAjaxValidation'=>false,
)); ?>
        <?php if($model->type!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'type'); ?>
                <?php echo $model->type; ?>
	</div>
        <?php endif;?>
        <?php if($model->list_law!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'list_law'); ?>
                <?php echo $model->list_law; ?>
	</div>
        <?php endif;?>
        <?php if($model->title_law!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'title_law'); ?>
                <?php echo $model->title_law; ?>
	</div>
        <?php endif;?>
        <?php if($model->date_law!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'date_law'); ?>
                <?php echo $model->date_law; ?>
	</div>
        <?php endif;?>
        <?php if($model->autor_law!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'autor_law'); ?>
                <?php echo $model->autor_law; ?>
	</div>
        <?php endif;?>
        <?php if($model->content_law!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'content_law'); ?>
                <?php echo $model->content_law; ?>
	</div>
        <?php endif;?>
        <?php if($model->img_law!=''):?>
        <div class="parse_div">
		<?php echo $form->label($model,'img_law'); ?>
                <?php echo $model->img_law; ?>
	</div>
        <?php endif;?>
        
	
        
	<div class="row buttons">
		<?php echo CHtml::submitButton('Parse',array("name"=>"Parse")); ?>
	</div>
  
<?php $this->endWidget(); ?>

</div><!-- form -->