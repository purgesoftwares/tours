<?php
	Router::connect('/cmspages/*', array('plugin' => 'cms', 'controller' => 'pages', 'action' => 'index'));
	Router::connect('/editpage/*', array('plugin' => 'cms', 'controller' => 'pages', 'action' => 'edit'));
	Router::connect('/addpage', array('plugin' => 'cms', 'controller' => 'pages', 'action' => 'add'));