<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property Category $Category
 */
class Post extends AppModel {

	public $actsAs = array(
		'Utils.Sluggable' => array(
				'label' => 'title',
				'slug' => 'slug',
				'separator' => '-',
				'length' => 250,
				'unique' => true,
				'update' => false
		),
		'Uploader.Attachment'=>array(
				'picture_upload_object'=>array(
					'dbColumn' => 'picture_upload',
					'tempDir' => TMP,
					'finalPath' => '/img/uploads/',
					'transforms' => array(
						'picture_upload_thumb' => array(
								'class' => 'crop',
								//'append' => '-single',
								//'overwrite' => false,
								'self' => false,
								'width' => 300,
								'height' => 200
						),
					)
				)
		),
		'Uploader.FileValidation' => array(
				'image' => array(
						'minWidth' => 800,
						'minHeight' => 200,
						//'extension' => array('gif', 'jpg', 'png', 'jpeg'),
						//'type' => 'image',
						//'mimeType' => array('image/gif'),
						//'filesize' => 2097152,
						//'required' => true
				)
		),
	);
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'des' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'views' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'status' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 *  increate views
 * 
 */
	public function increaseView($id) {
		$this->recursive = -1;
		$post = $this->read('id,views',$id);
		
		$post['Post']['views'] = $post['Post']['views']+1;
		
		$this->create();
		$this->save($post);
	}

/**
 * 
 *  find next post 
 *  it is a post that is posted after current one, and under the same category
 */
	public function getNext($post) {
		return $this->find('first',array('contain'=>false, 
										 'order'=>'ABS(TIMEDIFF("'.($post['Post']['created']).'", Post.created'.')) ASC',
										 'conditions'=>array('Post.id !='=>$post['Post']['id'], 
															 'Post.category_id'=>$post['Post']['category_id'], 
															 'Post.created >'=>$post['Post']['created'])));
	}	
	
/**
 *  find prev post
 *  it is a post that is posted before current one, and under the same category
 */
	public function getPrev($post) {
		return $this->find('first',array('contain'=>false, 
										 'order'=>'ABS(TIMEDIFF("'.($post['Post']['created']).'", Post.created'.')) ASC',
										 'conditions'=> array('Post.id !='=>$post['Post']['id'], 
															  'Post.category_id'=>$post['Post']['category_id'], 
															  'Post.created <='=>$post['Post']['created'])));
	}
	
/**
 * find posts which are under the same category
 */
	public function getRelated($id, $limit) {
		$this->recursive = -1;
		$self = $this->read('category_id',$id);
		
		return $this->find('all',array('contain'=>array('Category'), 
									   'limit'=>$limit,'order'=>array('Post.created DESC'),
									   'conditions'=>array('Post.id !='=>$id, 'Post.status'=>1, 'Post.category_id'=>$self['Post']['category_id'])));
	}
	
/**
 * get post data include category, by its slug
 */
	public function getPost($slug) {
		return $this->find('first',array('contain'=>array('Category'), 'conditions'=>array('Post.status'=>1, 'Post.slug'=>trim($slug))));
	}
	
/**
 * add/edit a post, validation is included
 */
	public function addPost($post) {
		// validate inputs
		if (TYPE_IMG == $post['Post']['type']) {
			// download from internet if needed
			if (!empty($post['Post']['picture_url'])) {
				$post['Post']['picture_upload_object'] = $post['Post']['picture_url'];
			}
		} elseif (TYPE_VID == $post['Post']['type']) {
			// youtube video
			$videoUrl = ($post['Post']['video_url']);
			if (false!==strpos(($videoUrl), 'youtube')) {
				parse_str(parse_url( $videoUrl, PHP_URL_QUERY ), $myArrayOfVars );
				$youtubeId = $myArrayOfVars['v'];  
				$this->log($youtubeId);
				$post['Post']['picture_upload_object'] = 'http://i1.ytimg.com/vi/'.$youtubeId.'/hqdefault.jpg';
				$post['Post']['video_url']= '//www.youtube.com/embed/'.$youtubeId;
			}
		}
		
		// save to database
		$this->create();
		if ($this->save($post)) {
			return true;
		}
		return false;
	}
}
