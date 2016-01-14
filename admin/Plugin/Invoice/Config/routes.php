<?php
	
Router::connect('/knowledgebase/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index','knowledge_base'));
Router::connect('/add-knowledgebase/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'add','knowledge_base'));
Router::connect('/edit-knowledgebase/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'edit','knowledge_base'));
Router::connect('/delete-knowledgebase/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'delete','knowledge_base'));

Router::connect('/sign_up_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index','sign_up_faqs'));
Router::connect('/add-sign_up_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'add','sign_up_faqs'));
Router::connect('/edit-sign_up_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'edit','sign_up_faqs'));
Router::connect('/delete-sign_up_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'delete','sign_up_faqs'));

Router::connect('/login_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index','login_faqs'));
Router::connect('/add-login_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'add','login_faqs'));
Router::connect('/edit-login_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'edit','login_faqs'));
Router::connect('/delete-login_faqs/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'delete','login_faqs'));

Router::connect('/faq/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index','faq'));
Router::connect('/add-faq/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'add','faq'));
Router::connect('/edit-faq/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'edit','faq'));
Router::connect('/delete-faq/*', array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'delete','faq'));

Router::connect('/video_tutorials/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'index'));
Router::connect('/add-video_tutorials/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'add'));
Router::connect('/edit-video_tutorials/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'edit'));
Router::connect('/delete-video_tutorials/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'delete'));
Router::connect('/active-video_tutorial/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'ChangeStatus',0));
Router::connect('/inactive-video_tutorial/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'ChangeStatus',1));
Router::connect('/set_default-video_tutorial/*', array('plugin' => 'faq', 'controller' => 'video_tutorials', 'action' => 'set_default'));
