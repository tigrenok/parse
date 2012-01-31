<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-6">
            <div style="padding: 20px 0px 20px 20px;">
                <?php if(!Yii::app()->user->isGuest) $this->widget('UserMenuPars'); ?>
                <?php if(!Yii::app()->user->isGuest) $this->widget('UserMenuPost'); ?>
            </div><!-- sidebar -->
	</div>
	<div class="span-18 last">
            <div id="content">
                    <?php echo $content; ?>
            </div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>