<?php
/**
 * Класс для постинга в блоги
 * @author CharnaD
 * @license MIT License + запрещено коммерческое распространение
 * @link http://www.charnad.com/
 * @version 0.2
 *
 */
class wp_poster {

	/**
     * Массив постов для отправки в блог
     * @var array
     */
    private $posts = array();

    /**
     * Массив блогов, если постим сразу в несколько.
     * @var array
     */
    private $blogs = array();

    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
        	self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {}
    private function __clone() {}

    private function _isUTF8() {
        return preg_match('%(?:
        [\xC2-\xDF][\x80-\xBF]
        |\xE0[\xA0-\xBF][\x80-\xBF]
        |[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
        |\xED[\x80-\x9F][\x80-\xBF]
        |\xF0[\x90-\xBF][\x80-\xBF]{2}
        |[\xF1-\xF3][\x80-\xBF]{3}
        |\xF4[\x80-\x8F][\x80-\xBF]{2}
        )+%xs', $string);
    }

    /**
     * Добавляет блог в массив блогов. Инициализирует адрес блога, пользователя, пароль и ID блога.
     * 0 для отдельностоящего wordpress, 0 по умолчанию.
     *
     * @param String $url
     * @param String $username
     * @param String $password
     * @param Int $blog_id = 0
     */
    public function addBlog(wp_blog $blog) {
        $this->blogs[] = $blog;
        return true;
    }

    public function addPost(wp_post $post) {
        $this->posts[] = $post;
        return true;
    }

    public function addBlogs($blogs) {
    	$result = true;
        foreach ($blogs as $blog) {
    	   $result = $result && $this->addBlog($blog);
        }
        return $result;
    }

    public function addPosts($posts) {
        $result = true;
        foreach ($posts as $post) {
        	$result = $result && $this->addPost($post);
        }
        return $result;
    }

	public function createCategories(wp_blog $blog, array $cats) {
		$errors = array();
        foreach ($cats as $cat) {
            $cat_structure = array('name' => $cat);
            $result = $blog->client->query("wp.newCategory", $blog->id, $blog->username, $blog->password, $cat_structure);
            if (!$result) {
                $errors[] = "Категория '{$cat}' не создана!";
            } else {
            	$response[] = $blog->client->getResponse();
            }
        }
        return count($errors)?$errors:$response;
	}

	public function massCreateCategories(array $cats) {
        foreach ($this->blogs as $blog) {
            $results[] = $this->createCategories($blog, $cats);
        }
        return $results;
    }


	public function getCategories (wp_blog $blog) {
        return $res = $blog->client->query("metaWeblog.getCategories", $blog->id, $blog->username, $blog->password);
	}

	public function post(wp_blog $blog, wp_post $post) {
		$responses = array();
		$post_array = $post->getArray();

	    $result = $blog->client->query("metaWeblog.newPost", $blog->id, $blog->username, $blog->password, $post_array, $post_array['post_status']);
	    if ($result) {
	        $responses[] = $blog->client->getResponse();
	    } else {
		    if (is_array($blog->client->getErrorMessage())) {
		        $responses[] = implode(':',$blog->client->getErrorMessage());
		    } else {
		        $responses[] = 'Error #'.$blog->client->getErrorCode().': '.$blog->client->getErrorMessage();
		    }
        }

        return $responses;
	}

	public function massPost(array $blogs = array(), array $posts = array()) {
        if (count($blogs) == 0) {
        	$blogs = $this->blogs;
        }
        if (count($posts) == 0) {
        	$blogs = $this->posts;
        }
		$responses = array();
        foreach ($posts as $post) {
        	foreach ($blogs as $blog) {
        		$responses[] = $this->post($blog, $post);
        	}
        }

        return $responses;
	}

}

class wp_post {

	private $post = array();
	private $flag = false;

    private function getFlag() {
    	return $this->flag;
    }
    
    private function setFlag($state) {
        $this->flag = (boolean)$state;
    }
	
	public function setPostType ($value) {
    	$value = strtolower($value);
        if (in_array($value, array('', 'post', 'page'))) {
    	   $this->post['post_type'] = $value;
        } else {
        	$this->post['post_type'] = '';
        	trigger_error('Post type excepted to be \'post\' or \'page\', or \'\'.', E_USER_NOTICE);
        }

        $this->setFlag(true);
        return true;
    }
    
    public function getPostType ($default = '') {
    	if (!isset($this->post['post_type'])) {
    		return strlen($default) ? $default : false;
    	} else {
    		return $this->post['post_type'];
    	}
    }

    public function setSlug ($value) {
        if (strlen($value) > 0) {
            $this->post['wp_slug'] = $value;
        }
        $this->setFlag(true);
        return true;
    }

    public function getSlug ($default = '') {
        if (!isset($this->post['wp_slug'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['wp_slug'];
        }   	
    }

    public function setPassword ($value) {
    	if (strlen($value) > 0) {
            $this->post['wp_password'] = $value;
    	}
    	$this->setFlag(true);
        return true;
    }

    public function getPassword ($default = '') {
        if (!isset($this->post['wp_slug'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['wp_slug'];
        }       
    }
     //only set a post parent if one was provided   
    public function setPageParentId ($value) {
        if (is_numeric($value)) {
            $this->post['wp_page_parent_id'] = intval($value);
        } else {
            trigger_error('Page parent id excepted to be an integer value.', E_USER_WARNING);
            return false;
        }
        $this->setFlag(true);
        return true;
    }
    
    public function getPageParentId ($default = 0) {
        if (!isset($this->post['wp_slug'])) {
            return intval($default) ? $default : false;
        } else {
            return $this->post['wp_slug'];
        }           
    }    
    
    //only set the menu_order if it was provided
    //самое интересное, что в вордпрессе нет такого параметра, есть menu_order, но что он значит я не знаю
    public function setPageOrder ($value) {
        if (is_numeric($value)) {
            $this->post['wp_page_order'] = intval($value);
        } else {
            trigger_error('Page order excepted to be an integer value.', E_USER_WARNING);
            return false;
        }
        $this->setFlag(true);
        return true;
    }

    public function getPageOrder ($default = 0) {
        if (!isset($this->post['wp_page_order'])) {
            return intval($default) ? $default : false;
        } else {
            return $this->post['wp_page_order'];
        }       
    }     
    
    public function setAuthorId ($value) {
    	if (is_numeric($value)) {
            $this->post['wp_author_id'] = intval($value);
    	} else {
            trigger_error('Author id excepted to be an integer value.', E_USER_WARNING);
            return false;
        }
        $this->setFlag(true);
        return true;
    }

    public function getAuthorId ($default = 0) {
        if (!isset($this->post['wp_author_id'])) {
            return intval($default) ? $default : false;
        } else {
            return $this->post['wp_author_id'];
        }       
    }      
    
    public function setTitle ($value) {
        if (strlen($value) > 0) {
            $this->post['title'] = $value;
        }
        $this->setFlag(true);
        return true;
    }
    
    public function getTitle($default = '') {
        if (!isset($this->post['title'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['title'];
        }  
    }

    public function setDescription ($value) {
        if (strlen($value) > 0) {
            $this->post['description'] = $value;
        }
        $this->setFlag(true);
        return true;
    }

    public function getDescription($default = '') {
        if (!isset($this->post['title'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['title'];
        }  
    }
    
    public function setPostStatus ($value) {
    	$value = strtolower(trim($value));
    	if (strlen($value) > 0 && in_array($value, array('publish', 'draft', 'private', 'pending'))) {
            $this->post['post_status'] = $value;
            $this->setPostType('post');
    	} else {
            trigger_error('Post status excepted to be \'publish\', \'draft\', \'private\' or \'pending\'.', E_USER_WARNING);
            return false;
    	}
    	$this->setFlag(true);
    	return true;
    }

    public function getPostStatus($default = '') {
        if (!isset($this->post['post_status'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['post_status'];
        }  
    }
    
    public function setPageStatus ($value) {
        $value = strtolower($value);
        if (strlen($value) > 0 && in_array($value, array('publish', 'draft', 'private'))) {
            $this->post['page_status'] = $value;
            $this->set_post_type('page');
        } else {
            trigger_error('Post status excepted to be \'publish\', \'draft\' or \'private\'.', E_USER_WARNING);
            return false;
        }
        $this->setFlag(true);
        return true;
    }

    public function getPageStatus($default = '') {
        if (!isset($this->post['page_status'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['page_status'];
        }  
    }    
    
    public function setExcerpt ($value) {
        if (strlen($value) > 0) {
            $this->post['mt_excerpt'] = $value;
        }
        $this->setFlag(true);
        return true;
    }
    
    public function getExcerpt($default = '') {
        if (!isset($this->post['mt_excerpt'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['mt_excerpt'];
        }  
    }

    public function setTextMore ($value) {
        if (strlen($value) > 0) {
            $this->post['mt_text_more'] = $value;
        }
        $this->setFlag(true);
        return true;
    }
    
    public function getTextMore($default = '') {
        if (!isset($this->post['mt_text_more'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['mt_text_more'];
        }  
    }    

    public function setKeywords ($value) {
    	if (is_array($value)) {
    		$value = implode(',', $value);
    	}
        if (strlen($value) > 0) {
            $this->post['mt_keywords'] = $value;
        }
        $this->setFlag(true);
        return true;
    }

    public function getKeywords($default = '') {
        if (!isset($this->post['mt_keywords'])) {
            return strlen($default) ? $default : false;
        } else {
            return $this->post['mt_keywords'];
        }  
    }    
    
    public function setAllowComments ($value) {
        $value = strtolower($value);
        if (is_numeric($value) && $value >= 0 && $value <= 2) {
            $this->post['mt_allow_comments'] = $value;
            $this->setFlag(true);
            return true;
        }

        if (strlen($value) > 0 && in_array($value, array('open', 'closed'))) {
            $this->post['mt_allow_comments'] = $value;
            $this->setFlag(true);
            return true;
        }

        trigger_error('Allow comments option excepted to be \'open\' or \'closed\', or numeric - 0 and 2 for closed, 1 for open.
        Otherwise default value will be used.', E_USER_NOTICE);
        return false;
    }

    public function getAllowComments($default = '') {
        if (!isset($this->post['mt_allow_comments'])) {
            return (strlen($default) || $default > 0) ? $default : false;
        } else {
            return $this->post['mt_allow_comments'];
        }  
    }      
    
    public function setAllowPings ($value) {
        $value = strtolower($value);
        if (is_numeric($value) && ($value == 0 || $value == 1)) {
            $this->post['mt_allow_pings'] = $value;
            $this->setFlag(true);
            return true;
        }

        if (strlen($value) > 0 && in_array($value, array('open', 'closed'))) {
            $this->post['mt_allow_pings'] = $value;
            $this->setFlag(true);
            return true;
        }

        trigger_error('Allow pings option excepted to be \'open\' or \'closed\', or numeric - 0 for closed, 1 for open.
        Otherwise default value will be used.', E_USER_NOTICE);
        return false;
    }

    public function getAllowPings($default = '') {
        if (!isset($this->post['mt_allow_pings'])) {
            return (strlen($default) || $default > 0) ? $default : false;
        } else {
            return $this->post['mt_allow_pings'];
        }  
    }      
    
    public function setPingUrls ($value) {
        if (is_array($value) && count ($value) > 0) {
            $this->post['mt_tb_ping_urls'] = $value;
        }
        $this->setFlag(true);
        return true;
    }
    
    public function getPingUrls($default = array()) {
        if (!isset($this->post['mt_tb_ping_urls'])) {
            return $default;
        } else {
            return $this->post['mt_tb_ping_urls'];
        }  
    }     

    public function setDateGmt ($value) {
        if (is_numeric($value)) {
            $this->post['date_created_gmt'] = new IXR_Date($value);
        }
        $this->setFlag(true);
        return true;
    }

    public function setDate ($value) {
        if (is_numeric($value)) {
            $this->post['dateCreated'] = new IXR_Date($value);
        }    	
        $this->setFlag(true);
        return true;
    }
    
    public function getDate($default = 0) {
        if (isset($this->post['dateCreated'])) {
            return $this->post['dateCreated']->getTimestamp();
        }
        if (isset($this->post['date_created_gmt'])) {
            return $this->post['date_created_gmt']->getTimestamp();
        }        
        if (is_numeric($default)) {
            return intval($default);        	
        }
    }

    public function setCategories ($value) {
        if (is_array($value)) {
        	if (empty($value)) {
        		return false;
        	}
            $this->post['categories'] = $value;
            $this->setFlag(true);
            return true;
        }

    	if (is_string($value)) {
    		if (strlen($value) < 1 || !strpos($value, ',')) {
    			return false;
    		}
            foreach (explode(',', $value) as $cat) {
            	$categories[] = trim($cat);
            }
    		$this->post['categories'] = $categories;
            $this->setFlag(true);
            return true;
        }
    return false;
    }
    
    public function getCategories($default = array()) {
        if (!isset($this->post['categories'])) {
            return $default;
        } else {
            return $this->post['categories'];
        }      	
    }

    public function setCustomFields ($value) {
        if (is_array($value) && count($value) > 0) {
            $this->post['custom_fields'] = $value;
        }
        $this->setFlag(true);
        return true;
    }

    public function getCustomFields($default = array()) {
        if (!isset($this->post['custom_fields'])) {
            return $default;
        } else {
            return $this->post['custom_fields'];
        }       
    }    
   
    
    //------- Setters

	public function __construct($array = array()) {
        if (count($array) > 1 && isset($array['title']) && strlen($array['title']) && 
                                 isset($array['description'])  && strlen($array['description'])) {
		    if (isset($array['title'])) {
	            $this->setTitle($array['title']);
	        }        
		    if (isset($array['description'])) {
	            $this->setDescription($array['description']);
	        }        
	        if (isset($array['dateCreated'])) {
	       	    $this->setDate($array['dateCreated']);
	        }
        }
	}

    public function getArray() {
        if (!isset($this->post['title'], $this->post['description'])) {
        	return false;
        }

    	return $this->post;
    }

}

class wp_comment {

	private $comment = array();

    public function __construct() {
        $argc = func_num_args();
        $argv = func_get_args();

        if ($argc == 1 && is_array($argv[0]) && isset($argv[0]['author'], $argv[0]['content'])) {
            $this->comment = $argv[0];
        }
    }

//    public function setVal($arg, $val) {
//        $post[strval($arg)] = $val;
//    }

    public function setArray($array) {
        if (is_array($rray) && isset($array['author'], $array['content'])) {
            $this->comment = $array;
        }
    }

    public function getArray() {
        if (!isset($this->comment['author'], $this->comment['content'])) {
            return false;
        }
        return $this->comment;
    }
}

class wp_blog {

	/**
     * Имя пользователя блога
     * @var String
     */
    public $username = '';

    /**
     * Пароль пользователя блога
     * @var String
     */
    public $password='';

    /**
     * Адрес xmlrpc.php в блоге
     *
     * @var unknown_type
     */
	public $url = '';

	/**
     * ID блога, по умолчанию 0
     * @var int
     */
    public $id = 0;

     /**
     * IXR_Client, для которого предназначен этот API
     * @var IXR_Client
     */
    public $client;

    public function __construct($url, $username, $password, $id = 0){
    	//TODO проверять урл
        if (strlen($url)) {
        	$this->url = $url;
        }

        if (strlen($username)) {
        	$this->username = $username;
        }

        if (strlen($password)) {
        	$this->password = $password;
        }

        if ($id != 0) {
        	$this->id = $id;
        }

        $this->client = new IXR_Client($url);
    }

    public function wp_getUserBlogs() {
        $result = $this->client->query("wp.getUserBlogs", $this->id, $this->username, $this->password, $id);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function wp_createCategories(array $cats) {
        $errors = array();
        foreach ($cats as $cat) {
        	if (is_array($cat)) {
        		if (!isset($cat['name'])) {
        		    $errors[] = "Не задано имя категории!";
        		    continue;
        		} else {
        			$cat_structure = array('name' => $cat['name']);
        		}
		        if (isset($cat['slug']) && strlen($cat['slug'])) {
		            $cat_structure['slug'] = $cat['slug'];
		        }
		        if (isset($cat['parent_id']) && strlen($cat['parent_id'])) {
		            $cat_structure['parent_id'] = intval($cat['parent_id']);
		        }
		        if (isset($cat['description']) && strlen($cat['description'])) {
		            $cat_structure['description'] = $cat['description'];
		        }
        	} elseif (is_string($cat)) {
                $cat_structure = array('name' => $cat);
        	}
            $result = $this->client->query("wp.newCategory", $this->id, $this->username, $this->password, $cat_structure);
            if (!is_int($result)) {
            	//TODO все ли правильно тут с эррорами? оказывается нет.. короче надо изучить
                $errors[] = "Категория '{$cat}' не создана! ";
            } else {
            	$results[] = $result;
            }
        }
        return count($errors)?$errors:$results;
    }

    public function wp_getCategories () {
        $res = $this->client->query("metaWeblog.getCategories", $this->id, $this->username, $this->password);
        return $res ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function wp_getCatNames() {
        $res = $this->client->query("metaWeblog.getCategories", $this->id, $this->username, $this->password);
        if (!$res) {
        	return $this->client->getErrorMessage();
        }

        $cats_array = array();
        foreach ($this->client->getResponse() as $cat) {
            $cats_array[] = $cat['categoryName'];
        }

        return $cats_array;
    }

    public function wp_newCategory($name, $slug = '', $parent_id = '', $description = '') {
        $cat_struct['name'] = $name;
        if (strlen($slug)) {
            $cat_struct['slug'] = $slug;
        }
        if (strlen($parent_id)) {
        	$cat_struct['parent_id'] = intval($parent_id);
        }
        if (strlen($description)) {
        	$cat_struct['description'] = $description;
        }
    	return $this->client->query("wp.newCategory", $this->id, $this->username, $this->password, $cat_struct);
    }

    public function wp_deleteCategory($id) {
        $result = $this->client->query("wp.deleteCategory", $this->id, $this->username, $this->password, $id);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function wp_getOptions($options = array()) {
        $result = $this->client->query("wp.getOptions", $this->id, $this->username, $this->password, $options);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function wp_setOptions() {

    }

    public function wp_getPage($page_id) {
    	$result = $this->client->query("wp.getPage", $this->id, intval($page_id), $this->username, $this->password);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function wp_getPages() {
        $result = $this->client->query("wp.getPages", $this->id, $this->username, $this->password);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function wp_newPage() {

    }

    public function wp_getCommentCount($post_id) {
        $result = $this->client->query("wp.getCommentCount", $this->id, $this->username, $this->password, $post_id);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }


    public function wp_getComment() {

    }
    
    public function getPost($id) {
        $result = $this->client->query("metaWeblog.getPost", $id, $this->username, $this->password);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();    	
    }

    /**
     * Получить комментарии
     *
     * @param  array $struct
     * @param  $struct['status'] = approved | awaiting_moderation | spam | total_comments <br>
     * @param  $struct['number'] = 10 <br>
     * @param  $struct['offset'] = 0 <br>
     * @param  $struct['post_id'] = 0 <br>
     *
     * @return Responce || false
     */
    public function wp_getComments($struct = array()) {
        $result = $this->client->query("wp.getComments", $this->id, $this->username, $this->password, $struct);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    /**
     * Удалить комментарий
     *
     * @param int $id
     * @return bool|string
     */
    public function wp_deleteComment($id) {
        $result = $this->client->query("wp.deleteComment", $this->id, $this->username, $this->password, $id);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    /**
     * Меняет статус комментария, по умолчанию на approved.
     *
     * @param int $comment_id
     * @param string $status approved|hold|spam
     * @return bool|string
     */
    public function wp_editCommentStatus($comment_id, $status = 'approved') {
        $result = $this->client->query("wp.editComment", $this->id, $this->username, $this->password, $comment_id, array('status' => $status));
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

//$comment_edit_struct['status']
//$comment_edit_struct['date_created_gmt']
//$comment_edit_struct['content']
//$comment_edit_struct['author']
//$comment_edit_struct['author_url']
//$comment_edit_struct['author_email']
    public function wp_editComment($comment_id, $comment_edit_struct) {
        $result = $this->client->query("wp.editComment", $this->id, $this->username, $this->password, $comment_id, $comment_edit_struct);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    /**
     * Создать новый комментарий
     *
     * @param int|string(url) $post
     * @param array $comment_struct
     * @param $comment_struct['author']
     * @param $comment_struct['author_email']
     * @param $comment_struct['author_url']
     * @param $comment_struct['content']
     * @return array|false
     */
    public function wp_newComment($post, wp_comment $comment) {
    	$comment_array = $comment->getArray();
    	//$comment_array['content'] .= iconv('','utf-8',"<br>____________<br>Отправлено с помощью <a href='http://www.charnad.com/'>CharnaD's wp-poster</a>");
        $result = $this->client->query("wp.newComment", $this->id, $this->username, $this->password, $post, $comment_array);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    /**
     * Получить список статусов комментариев
     *
     * @return array
     */
    public function wp_getCommentStatusList() {
        $result = $this->client->query("wp.getCommentStatusList", $this->id, $this->username, $this->password);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    /**
     * Получить список статусов постов
     *
     * @return array
     */
    public function wp_getPostStatusList() {
        $result = $this->client->query("wp.getPostStatusList", $this->id, $this->username, $this->password);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();
    }

    public function blogger_getPost($id) {
        $result = $this->client->query("blogger.getPost", $this->id, $id, $this->username, $this->password);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();

    }
    
    public function uploadFile($name, $filename, $type = 'image/jpeg', $overwrite = true) {
        $data = array(
            'name' => $name,
            'bits' => new IXR_Base64(file_get_contents($filename)),
            'type' => $type,
            'overwrite' => $overwrite
        );
    	
    	$result = $this->client->query("metaWeblog.newMediaObject", $this->id, $this->username, $this->password, $data);
        return $result ? $this->client->getResponse() : $this->client->getErrorMessage();    	
    }
//TODO разобраться с getErrorMessage везде

//
//                'wp.getUsersBlogs'      => 'this:wp_getUsersBlogs',
//            'wp.getPage'            => 'this:wp_getPage',
//            'wp.getPages'           => 'this:wp_getPages',
//            'wp.newPage'            => 'this:wp_newPage',
//            'wp.deletePage'         => 'this:wp_deletePage',
//            'wp.editPage'           => 'this:wp_editPage',
//            'wp.getPageList'        => 'this:wp_getPageList',
//            'wp.getAuthors'         => 'this:wp_getAuthors',
//       +    'wp.getCategories'      => 'this:mw_getCategories',     // Alias
//       +    'wp.newCategory'        => 'this:wp_newCategory',
//       +    'wp.deleteCategory'     => 'this:wp_deleteCategory',
//            'wp.suggestCategories'  => 'this:wp_suggestCategories',
//            'wp.uploadFile'         => 'this:mw_newMediaObject',    // Alias
//       +    'wp.getCommentCount'    => 'this:wp_getCommentCount',
//            'wp.getPostStatusList'  => 'this:wp_getPostStatusList',
//            'wp.getPageStatusList'  => 'this:wp_getPageStatusList',
//            'wp.getPageTemplates'   => 'this:wp_getPageTemplates',
//       +    'wp.getOptions'         => 'this:wp_getOptions',
//            'wp.setOptions'         => 'this:wp_setOptions',
}
?>