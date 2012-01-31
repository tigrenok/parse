<ul>
  <li><?php echo CHtml::link('Сайты ('. (int)Sites::getcount() .')',array('sites/')); ?></li>
  <li><?php echo CHtml::link('Правила ('. (int)Law::getcount() .')',array('law/')); ?></li>
</ul>