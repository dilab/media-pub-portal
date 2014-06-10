<?php
App::uses('AppController', 'Controller');

/**
 *
 * @property Post
 */
class PostsController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('menu','posts');
		
		$this->Auth->allow(array('submit', 'categoryList','home','home_more','view'));
	}
	
	public function submit() {
		
		if ($this->request->is('post')) {
			$this->Session->setFlash(__('Submission is disabled in demo'),'msg/failure');
		}
		
		$title_for_layout = __('Submit Pictures, GIFS or Videos');
		$this->set(compact('title_for_layout'));
	}
	
	public function home($categoryId=null) {
		$conditions = null;
		if (null!=$categoryId) {
			$conditions ['Post.category_id'] = $categoryId;
		}
		
		$posts = $this->Post->find('all',array( 'conditions'=>$conditions,
												'limit'=>$this->settings['home_page_default'], 
												'order'=>'Post.created DESC','contain'=>false));
		
		
		$this->set(compact('posts','categoryId'));
	}
	
	public function home_more() {
		$this->layout='ajax';
		
		$posts=null;
		if ($this->request->is('post')) {
			$conditions = null;
			$categoryId = $this->request->data('category_id');
			$page       = $this->request->data('page');
			$postsPerPage = $this->settings['home_page_load_more'];
			$defaultPerPage = $this->settings['home_page_default'];
			
			if (null!=$categoryId) {
				$conditions ['Post.category_id'] = $categoryId;
			}
			
			$offset = $defaultPerPage + ($page-1)*($postsPerPage);
			
			$posts = $this->Post->find('all',array( 'conditions'=>$conditions,
													'limit'=>$postsPerPage,
													'offset'=>$offset,
													'order'=>'Post.created DESC','contain'=>false));
		}
		
		$this->set(compact('posts'));
	}
	
	public function view($slug) {
		
		$post = $this->Post->getPost($slug);
		if (null==$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$categoryId = $post['Post']['category_id'];
		
		// next post is just a post that is posted after current one, and under the same category
		$nextPost = $this->Post->getNext($post);
		
		// prev post is just a post that is posted before current one, and under the same category
		$prevPost = $this->Post->getPrev($post);
		
		// find related posts
		$related = $this->Post->getRelated($post['Post']['id'], $this->settings['single_page_related']);
		
		// increate views count
		$this->Post->increaseView($post['Post']['id']);
		
		$title_for_layout = $post['Post']['title'];
		
		$this->set(compact('post','categoryId','related','nextPost','prevPost','title_for_layout'));
	}
	
	public function categoryList() {
		return $this->Post->Category->find('all',array('fields'=>array('id','name','icon'),'order'=>array('order_seq'=>'ASC'),'contain'=>false));
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($categoryId=-1,$status=-1) {

		$this->Post->recursive = 0;

		$conditions = null;

		if (-1!=$categoryId) {
			$conditions ['Post.category_id'] = $categoryId;
            $stats = $this->Post->getStatsByCat($categoryId);
		} else {
            $stats = $this->Post->getStats();
        }
		
		if (-1!=$status) {
			$conditions ['Post.status'] = $status;
		}
		
		$this->Paginator->settings['conditions'] = $conditions;
		
		$this->set('posts', $this->Paginator->paginate());
		$this->set('categoryId',$categoryId);
		$this->set('status',$status);
        $this->set('stats',$stats);
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
		
		$this->render('view');
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($categoryId=null) {
		$this->Post->Category->recursive = -1;
		$category = $this->Post->Category->read(null,$categoryId);
		
		if ($this->request->is('post')) {
			$this->request->data['Post']['category_id'] = $categoryId;
			$this->request->data['Post']['type'] = $category['Category']['type'];
			if ($this->Post->addPost($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved.'),'msg/success');
				return $this->redirect(array('action' => 'index',$categoryId));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'),'msg/failure');
			}
		}
		
		
		$this->set('categoryId',$categoryId);
		$this->set('category',$category);
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->addPost($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved.'),'msg/success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->log($this->Post->validationErrors);
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'),'msg/failure');
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
			
			
		}
		
		$this->Post->Category->recursive = -1;
		$categoryId = $this->request->data['Post']['category_id'];
		$category = $this->Post->Category->read(null,$categoryId);
		
		$this->set('categoryId',$categoryId);
		$this->set('category',$category);
		
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('The post has been deleted.'),'msg/success');
		} else {
			$this->Session->setFlash(__('The post could not be deleted. Please, try again.'),'msg/failure');
		}
		return $this->redirect(array('action' => 'index'));
	}}
