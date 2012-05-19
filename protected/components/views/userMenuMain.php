<ul>
  <li><?php echo CHtml::link('Пользователи ('.((int) Comp::getcount('user')).')',array('/user/index')); ?></li>
  <li><?php echo CHtml::link('Кодировка ('.((int)  Comp::getcount('coding')).')',array('/coding/index')); ?></li>
  <li><?php echo CHtml::link('Тип файлов ('.((int) Comp::getcount('upload_type')).')',array('/uploadType/index')); ?></li>
</ul>