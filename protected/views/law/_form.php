<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'law-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'law_type_id'); ?>
		<?php echo $form->dropDownList($model, 'law_type_id', Comp::getlist('LawType', 'id', 'name'));?>
		<?php echo $form->error($model,'law_type_id'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'stop'); ?>
		<?php echo $form->textField($model,'stop'); ?>
		<?php echo $form->error($model,'stop'); ?>
	</div>
  <?php foreach ($fealds as $key => $value) :?>
   	<div class="row">
      <?php echo Chtml::label($value->value,$value->value);?> 
      <?php if(in_array($value->id , array(7,6,8))):?>
      <?php echo Chtml::textArea("Law[fields][".$value->id."]",(isset($fealdsthis[$value->id]))?$fealdsthis[$value->id]:'',array('rows'=>5,'cols'=>30));?>
      <?php else:?>      
      <?php echo Chtml::textField("Law[fields][".$value->id."]",(isset($fealdsthis[$value->id]))?$fealdsthis[$value->id]:'');?>
      <?php endif;?>
	</div>
 <?php endforeach;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<div class="help">
    <h3>Интервал страниц</h3>
        <b>бязательно:</b> 
        <p>Description</p> 
    <h3>Список ссылкок страниц</h3>
        <b>Обязательно</b>
        <p>Description <br />
            content - a[class=post_title]</p>
    <h3>Список блоков</h3>
        <b>Обязательно</b>
        <p>Description <br />
            content - a[class=post_title]</p>
        <b>Желательно</b>
        <p>Stop - id <br />
            header - h1[class=title]</p>
    <h3>Одиночка</h3>
        <b>Обязательно</b>
        <p>Description  <br />
            Stop - id <br />
            header - h1[class=title]<br />
            content - a[class=post_title]
           </p>
    <h3>Дополнительно</h3>
        <p>img - self::imgcontent($content)  <br />
            video - self::videocontent($content,'div[class=media_desc] a',преф_урл) <br />
            audio - self::audiocontent($content,'div[class=audio_title_wrap] a','http://vk.com')
           </p>
    
        
</div>