<div class="form">

  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'content-form',
      'enableAjaxValidation' => false,
          ));
  ?>
  <?php echo $form->errorSummary($model); ?>

  <div class="row">
    <?php echo $form->labelEx($model, 'data'); ?>
    <?php echo $form->textArea($model, 'data', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'data'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'date_public'); ?>
    <?php
    $form->widget('zii.widgets.jui.CJuiDatePicker', array('language' => 'ru',
        'model' => $model,
        'attribute' => 'date_public',
        'options' => array('dateFormat'=>'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'showButtonPanel' => 'true', 'constrainInput' => 'false'))
    );
    ?>
    <?php echo $form->error($model, 'date_public'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'date_parse'); ?>
    <?php
    $form->widget('zii.widgets.jui.CJuiDatePicker', array('language' => 'ru',
        'model' => $model,
        'attribute' => 'date_parse',
        'options' => array('dateFormat'=>'yy-mm-dd','changeMonth' => 'true', 'changeYear' => 'true', 'showButtonPanel' => 'true', 'constrainInput' => 'false'))
    );
    ?>
    <?php echo $form->error($model, 'date_parse'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'site_id'); ?>
		<?php echo $form->dropDownList($model, 'site_id', Comp::getlistv('SitePars', 'id', 'url'));?>
    <?php echo $form->error($model, 'site_id'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->