<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'content-form',
        'enableAjaxValidation' => false,
            ));
    ?>
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php
        $data = unserialize($model->data);
        foreach ($data as $key => $value):
            if ($key != 'content'):
                echo CHtml::label($key, 'Content[data][' . $key . ']');
                echo CHtml::textField('Content[data][' . $key . ']', $value);
            else:
                echo CHtml::label($key, 'Content[data][' . $key . ']');
                echo CHtml::link("Min", "#", array('id' => "textarea_min"));
                echo CHtml::textArea('Content[data][' . $key . ']', $value, array('rows' => 40, 'cols' => 130));
            endif;
        endforeach;
        ?>
        <?php echo $form->error($model, 'data'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_public'); ?>
        <?php
        $form->widget('zii.widgets.jui.CJuiDatePicker', array('language' => 'ru',
            'model' => $model,
            'attribute' => 'date_public',
            'options' => array('dateFormat' => 'yy-mm-dd', 'changeMonth' => 'true', 'changeYear' => 'true', 'showButtonPanel' => 'true', 'constrainInput' => 'false'))
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
            'options' => array('dateFormat' => 'yy-mm-dd', 'changeMonth' => 'true', 'changeYear' => 'true', 'showButtonPanel' => 'true', 'constrainInput' => 'false'))
        );
        ?>
        <?php echo $form->error($model, 'date_parse'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_id'); ?>
        <?php echo $form->dropDownList($model, 'site_id', Comp::getlistv('SitePars', 'id', 'url')); ?>
        <?php echo $form->error($model, 'site_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>
    <h3>Настройки для постинга</h3>
    <div class='hidden'>
        <div class="parse_help">
            <b>Обязательно:</b> 
            <p>Site</p> 
        </div>
        <div id='parse_site_info'>
        
        </div>
    </div>

    <?php echo CHtml::beginForm('/postSite/post', "POST"); ?>

    <div class="row">
        <?php echo CHtml::label('Site', 'post_site_id'); ?>
        <?php echo CHtml::dropDownList('post_site_id', 0, Comp::getlistv('PostSite', 'id', 'name')); ?>
    </div>

    <div class="row">
        <?php echo CHtml::label('Site Categories', 'post_site_categories_id'); ?>
        <div id='post_site_categories'>
            <?php echo CHtml::dropDownList('post_site_categories', 0, array(0 => "Выбрать"), array('disabled' => 'disabled')); ?>
        </div>
    </div>

    <div class="row" id='post_site_categories'>
        <?php echo CHtml::label('Site Tags', 'post_site_tags_id'); ?>
        <?php echo CHtml::textField('post_site_tags'); ?>
    </div>

    <?php echo CHtml::submitButton('Post'); ?>
    <?php echo CHtml::endForm(); ?>    

</div><!-- form -->