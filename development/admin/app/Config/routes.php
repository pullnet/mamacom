<?php
	Router::connect('/', array('controller' => 'main', 'action' => 'index'));
	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';
