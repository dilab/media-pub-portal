<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	
	public $components = array(
			'DebugKit.Toolbar',
			'Auth'=>array(
					'loginAction' =>array(
							'controller' => 'users',
							'action' => 'login',
							'plugin' => 'cakeuser',
							'admin'=>false
					)
			),
			'Session',
			'Cookie'
	);
	
	public $helpers = array('Facebook.Facebook');
	
	public $settings = array('home_page_default'=>6,
							 'home_page_load_more'=>3,
							 'single_page_related'=>3);
	
	public function beforeFilter() {
		$this->setPageTitle();
		$this->setLayout();
		$this->setAdminMenu();
		$this->setOptions();
		
		
	}
	
	public function setPageTitle() {
		$title_for_layout = __('Media Pub Portal');
		
		$this->set(compact('title_for_layout'));
	}
	
	public function setLayout() {
		if (isset($this->request->params['admin']) && $this->request->params['admin']) {
			$this->layout = 'default-admin';
		}
	}
	
	public function setAdminMenu() {
		if (isset($this->request->params['admin']) && $this->request->params['admin']) {
			$menu = '';
			$this->set(compact('menu'));
		}
	}
	
	public function setOptions() {
		$this->set('settings',$this->settings);
	}
	
	/*
	 * Cakeuser integration
	 */
	public function _redirect() {
		$this->redirect(array('controller'=>'posts','action'=>'index','plugin'=>null,'admin'=>true));
	}
}