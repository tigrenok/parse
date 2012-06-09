<?php

class PostComponent extends CApplicationComponent {

  /**
   * Стартова функция
   * @param type $data
   * @return type 
   */
  public static function go($data) {
    Yii::import('application.vendors.*');
    require_once ('ixr_client.php');
    require_once ('wp_poster.php');

    $config = $data['config'];
    
    
/*
    
      $wp = new xmlrpc_client($config->rpc_script, $config->name, 80);
      //кодировка клиента
      $wp->request_charset_encoding = 'UTF-8';
      //чтоб возвращал в виде php-переменных
      $wp->return_type = 'phpvals';

    
 



//собираем все в кучу
$params = array( //ид блога
new xmlrpcval(0, 'int'), //логин
new xmlrpcval($u_name, 'string'), //пароль
new xmlrpcval($u_pass, 'string'), //данные
new xmlrpcval($struct, 'struct'),
//публикация: true - опубликована,
//false - не опубликована
new xmlrpcval(true, 'boolean'));
 
//вызываем процедуру metaWeblog.newPost
$r = $wp->send(new xmlrpcmsg('metaWeblog.newPost', $params));
//если ошибка, сообщаем об ошибке постинга
if ($r->faultCode()) {
die('Ошибка постинга:' . $r->faultString());
}
//WP вернет идентификатор поста в случае успеха
$p = $r->value();
 
echo 'Запостили пост успешно. Его идентификатор '.
'имеет номер ' . $p .'. Прочитать статью можно'.
' <a href="http://test.wordpress.loc/?p=' . $p .     '">здесь</a> ';
     */

    $struct = array();

    return $config;
  }

}
