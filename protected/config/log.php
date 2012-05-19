  <?php
$config['components']['log'] = array(
  'class'=>'CLogRouter',
  'routes'=>array(
        array(
            'class' => 'CWebLogRoute',
            'categories' => 'application',
            'showInFireBug' => true,
            'levels'=>'error, warning, trace, profile, info',            
            'categories' => 'system.db.CDbCommand',
            
        ),      
  ),
);