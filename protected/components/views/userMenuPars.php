<ul>
  <li><?php echo CHtml::link('Тип правила ('.((int) Comp::getcount('law_type')).')',array('lawType/index')); ?></li>
  <li><?php echo CHtml::link('Правил ('.((int) Comp::getcount('law')).')',array('law/index')); ?></li>
  <li><?php echo CHtml::link('Сайты ('.((int) Comp::getcount('site_pars')).')',array('sitePars/index')); ?></li>
  <li><?php echo CHtml::link('Элементы правил ('.((int) Comp::getcount('law_field')).')',array('lawField/index')); ?></li>
  <li><?php echo CHtml::link('Типы элементов правил ('.((int) Comp::getcount('law_field_type')).')',array('lawFieldType/index')); ?></li>
</ul>