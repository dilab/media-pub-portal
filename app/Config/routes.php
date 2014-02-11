<?php
    
	Router::connect('/', array('controller' => 'posts', 'action' => 'home','admin'=>false,'plugin'=>null));

	Router::connect('/admin', array('controller' => 'posts', 'action' => 'index','admin'=>true));
	
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	CakePlugin::routes();

	/**
	 * Load the CakePHP default routes. Only remove this if you do not want to use
	 * the built-in default routes.
	 */
	require CAKE . 'Config' . DS . 'routes.php';
