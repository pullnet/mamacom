<?php
	Router::connect('/', array('controller' => 'main', 'action' => 'index'));

	CakePlugin::routes();


/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
