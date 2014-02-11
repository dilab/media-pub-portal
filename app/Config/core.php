<?php
	require_once dirname(__DIR__) . '/Vendor/autoload.php';

	// set it to 1 for demo mode
	Configure::write('demo',1);

    Configure::write('debug', 0);
    
	Configure::write('Error', array(
		'handler' => 'ErrorHandler::handleError',
		'level' => E_ALL & ~E_DEPRECATED,
		'trace' => true
	));

	Configure::write('Exception', array(
		'handler' => 'ErrorHandler::handleException',
		'renderer' => 'ExceptionRenderer',
		'log' => true
	));

	Configure::write('App.encoding', 'UTF-8');

	//Configure::write('App.baseUrl', env('SCRIPT_NAME'));

	//Configure::write('App.fullBaseUrl', 'http://example.com');

	//Configure::write('App.imageBaseUrl', 'img/');

	//Configure::write('App.cssBaseUrl', 'css/');

	//Configure::write('App.jsBaseUrl', 'js/');
	
	Configure::write('Routing.prefixes', array('admin'));

	//Configure::write('Cache.disable', true);

	//Configure::write('Cache.check', true);

	//Configure::write('Cache.viewPrefix', 'prefix');

	Configure::write('Session', array(
		'defaults' => 'php'
	));

	Configure::write('Security.salt', '12hG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi');

	Configure::write('Security.cipherSeed', '12859309657453542496749683645');

	//Configure::write('Asset.timestamp', true);

	//Configure::write('Asset.filter.css', 'css.php');

	//Configure::write('Asset.filter.js', 'custom_javascript_output_filter.php');

	Configure::write('Acl.classname', 'DbAcl');
	Configure::write('Acl.database', 'default');

	//date_default_timezone_set('Asia/Singapore');

	$engine = 'File';
	
	// In development mode, caches should expire quickly.
	$duration = '+999 days';
	if (Configure::read('debug') > 0) {
		$duration = '+10 seconds';
	}
	
	// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
	$prefix = 'mpp';
	
	Cache::config('_cake_core_', array(
		'engine' => $engine,
		'prefix' => $prefix . 'cake_core_',
		'path' => CACHE . 'persistent' . DS,
		'serialize' => ($engine === 'File'),
		'duration' => $duration
	));
	
	/**
	 * Configure the cache for model and datasource caches. This cache configuration
	 * is used to store schema descriptions, and table listings in connections.
	 */
	Cache::config('_cake_model_', array(
		'engine' => $engine,
		'prefix' => $prefix . 'cake_model_',
		'path' => CACHE . 'models' . DS,
		'serialize' => ($engine === 'File'),
		'duration' => $duration
	));
