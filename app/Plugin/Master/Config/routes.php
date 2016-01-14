<?php
	
	Router::connect('/services/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'index','services'));
	Router::connect('/add-service/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'add','services'));
	Router::connect('/edit-service/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'edit','services'));
	Router::connect('/delete-service/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'delete','services'));

	Router::connect('/forum-categories/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'index','forum_categories'));
	Router::connect('/add-forum-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'add','forum_categories'));
	Router::connect('/edit-forum-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'edit','forum_categories'));
	Router::connect('/delete-forum-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'delete','forum_categories'));

	Router::connect('/knowledge-base-categories/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'index','knowledge_base_categories'));
	Router::connect('/add-knowledge-base-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'add','knowledge_base_categories'));
	Router::connect('/edit-knowledge-base-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'edit','knowledge_base_categories'));
	Router::connect('/delete-knowledge-base-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'delete','knowledge_base_categories'));

	Router::connect('/faq-categories/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'index','faq_categories'));
	Router::connect('/add-faq-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'add','faq_categories'));
	Router::connect('/edit-faq-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'edit','faq_categories'));
	Router::connect('/delete-faq-category/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'delete','faq_categories'));

	Router::connect('/expected_incoterms/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'index','expected_incoterms'));
	Router::connect('/add-expected_incoterms/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'add','expected_incoterms'));
	Router::connect('/edit-expected_incoterms/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'edit','expected_incoterms'));
	Router::connect('/delete-expected_incoterms/*', array('plugin' => 'master', 'controller' => 'categories', 'action' => 'delete','expected_incoterms'));