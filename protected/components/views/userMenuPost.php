<ul>
  <li><?php echo CHtml::link('Статьи ('.((int) Comp::getcount('content')).')',array('content/index')); ?></li>
  <li><?php echo CHtml::link('Сайты ('.((int) Comp::getcount('post_site')).')',array('postSite/index')); ?></li>
  <li><?php echo CHtml::link('Категории ('.((int) Comp::getcount('post_site_categories')).')',array('postSiteCategories/index')); ?></li>
  </ul>