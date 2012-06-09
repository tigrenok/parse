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
    
    //данные авторизации на блог
    $blog_login = $config->login;
    $blog_pass = $config->pass;
    $blog_xmlrpc = $config->site;

    //инициализация процесса :)
    $poster = wp_poster::getInstance();
    $blog = new wp_blog($blog_xmlrpc, $blog_login, $blog_pass, 0);

    //запоминаем текущее время в формате timestamp
    $text = $data['content'];
    $params = $data['params'];
    $time = time() + ((int) $params['post_time_mines']) + rand(-3600, 3600);
    
    if ($tmp_cat = PostSiteCategories::model()->findByPk((int) $params['post_site_categories']))
      $categories = $tmp_cat->value;
    else
      $categories = 'Без рубрики';
    
      $blog->wp_createCategories(array($categories)); //создаём новую категорию в блоге (даже если она уже есть, ничё страшного)
      $post = new wp_post(); //новый пост
      $post->setTitle(isset($text['header'])?$text['header']:''); //задаём заголовок в UTF8-кодировке
      $post->setDescription($text['content']); //задаём контент в UTF8
      $post->setPostStatus('publish');//статус поста
      $post->setPostType('post');//тип поста
      $post->setDate($time); //время публикации поста
      $post->setCategories(array($categories)); //указываем категорию поста
      if(!empty($params['post_site_tags']))
      $post->setKeywords(array(explode (',', $params['post_site_tags']))); 
      // $res = $poster->post($blog, $post); //отправляем все данные блогу
     
    return $data['params'];
  }

}
