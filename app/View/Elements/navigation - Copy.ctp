<?php
  $AdminData = array('username'=>'Admin');
  $pc	=	$this->params['plugin'].'/'.$this->params['controller'];	
  $dashboardclass		=	'';
  $userclass			=	'';
  $catclass				=	'';
  $newsletterclass		=	'';
  $newsclass			=	'';
  $cmsclass				=	'';
  $blogclass			=	'';
  $settingclass			=	'';
  $moreclass			=	'';
  if(in_array($pc,array('/pages'))){
	$dashboardclass	=	'active';
  }else if(in_array($pc,array('usermgmt/customers','usermgmt/promoters','usermgmt/partners'))){
	$userclass	=	'active';
  }else if(in_array($pc,array('category/categories','category/sub_categories','producttype/producttypes','producttype/servicetypes'))){
	$catclass	=	'active';
  }else if(in_array($pc,array('newsletter/newsletters','newsletter/newsletter_templates','newsletter/newsletter_subscribers'))){
	$newsletterclass	=	'active';
  }else if(in_array($pc,array('news/news'))){
	$newsclass	=	'active';
  }else if(in_array($pc,array('cms/pages'))){
	$cmsclass	=	'active';
  }else if(in_array($pc,array('forum/forums','forum/forum_posts'))){
	$blogclass	=	'active';
  }else if(in_array($pc,array('settings/settings','forum/forum_posts','email/email_templates'))){
	$settingclass	=	'active';
  }else if(in_array($pc,array('district/districts','county/counties','country/countries'))){
	$moreclass	=	'active';
  }
?>
<div class="container-fluid">
		<?php echo $this->Html->link($this->Html->image('logo2.png'),array('plugin'=>false,'controller'=>'pages','action'=>'display'),array('id'=>'brand','escape'=>false)); ?>
			
			<ul class='main-nav'>
				<li class='<?php echo $dashboardclass; ?>'>
					<?php echo $this->Html->link('<span>'.__('Dashboard').'</span>',array('plugin'=>false,'controller'=>'pages','action'=>'display'),array('escape'=>false)); ?>
				</li>
				<li class='<?php echo $userclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('Users'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Customer'),array('plugin'=>'usermgmt','controller'=>'customers','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Backoffice users'),array('plugin'=>'usermgmt','controller'=>'promoters','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Partners'),array('plugin'=>'usermgmt','controller'=>'partners','action'=>'index'),array('escape'=>false)); ?>
						</li>
						
					</ul>
				</li>
				<li class='<?php echo $catclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('Management'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Campaigns'),'javascript:void(0);',array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Categories'),array('plugin'=>'category','controller'=>'categories','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Sub-Categories'),array('plugin'=>'category','controller'=>'sub_categories','action'=>'index'),array('escape'=>false)); ?>
						</li>
						
						<li>
							<?php echo $this->Html->link(__('Product types'),array('plugin'=>'producttype','controller'=>'producttypes','action'=>'index'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Service types'),array('plugin'=>'producttype','controller'=>'servicetypes','action'=>'index'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Payments'),'javascript:void(0);',array('escape'=>false)); ?>
							
						</li>
						
					</ul>
				</li>
				<li class='<?php echo $newsletterclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('Newsletters'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('View newsletters'),array('plugin'=>'newsletter','controller'=>'newsletters','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Add Template'),array('plugin'=>'newsletter','controller'=>'newsletter_templates','action'=>'add'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Templates'),array('plugin'=>'newsletter','controller'=>'newsletter_templates','action'=>'index'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('View subscribers'),array('plugin'=>'newsletter','controller'=>'newsletter_subscribers','action'=>'index'),array('escape'=>false)); ?>
							
						</li>
					</ul>
				</li>
				<li class='<?php echo $newsclass; ?>'>
					<?php echo $this->Html->link(__('News'),array('plugin'=>'news','controller'=>'news','action'=>'index'),array('escape'=>false)); ?>
				</li>
				
				<li class='<?php echo $cmsclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('CMS'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Home page'),array('plugin'=>'cms','controller'=>'pages','action'=>'home'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Terms and conditions'),array('plugin'=>'cms','controller'=>'pages','action'=>'terms_conditions','terms_conditions'),array('escape'=>false)); ?>
						</li>
						
					</ul>
				</li>
				<li class='<?php echo $blogclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('Blog'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Add post'),array('plugin'=>'forum','controller'=>'forums','action'=>'add'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Views posts'),array('plugin'=>'forum','controller'=>'forums','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Manage comments'),array('plugin'=>'forum','controller'=>'forum_posts','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Manage tags'),'javascript:void(0);',array('escape'=>false)); ?>
						</li>
					</ul>
				</li>
				<li class='<?php echo $settingclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('Settings'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Site settings'),array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix','Site'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Blog'),array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix','Blog'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Payment settings'),'javascript:void(0);',array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Advertising'),'javascript:void(0);',array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Email templates'),array('plugin' => 'email', 'controller' => 'email_templates', 'action' => 'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Vouchers'),'javascript:void(0);',array('escape'=>false)); ?>
						</li>
					</ul>
				</li>
				<li class='<?php echo $moreclass; ?>'>
					<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'>
						<span><?php echo __('More'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Districts'),array('plugin' => 'district', 'controller' => 'districts', 'action' => 'index'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Counties'),array('plugin' => 'county', 'controller' => 'counties', 'action' => 'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Countries'),array('plugin' => 'country', 'controller' => 'countries', 'action' => 'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Faq').'\'s',array('plugin' => 'faq', 'controller' => 'faqs', 'action' => 'index'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Export accounting file'),'javascript:void(0);',array('escape'=>false)); ?>
						</li>
						
					</ul>
				</li>
			</ul>
			<div class="user">
				<ul class="icon-nav">
					<li class='dropdown'>
						<a href="javascript:void(0);" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
						<ul class="dropdown-menu pull-right message-ul">
							<li>
								<a href="javascript:void(0);">
								<?php echo $this->Html->image('demo/user-1.jpg'); ?>
									
									<div class="details">
										<div class="name">Jane Doe</div>
										<div class="message">
											Lorem ipsum Commodo quis nisi ...
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);">
									<?php echo $this->Html->image('demo/user-2.jpg'); ?>
									<div class="details">
										<div class="name">John Doedoe</div>
										<div class="message">
											Ut ad laboris est anim ut ...
										</div>
									</div>
									<div class="count">
										<i class="icon-comment"></i>
										<span>3</span>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript:void(0);">
									<?php echo $this->Html->image('demo/user-3.jpg'); ?>
									<div class="details">
										<div class="name">Bob Doe</div>
										<div class="message">
											Excepteur Duis magna dolor!
										</div>
									</div>
								</a>
							</li>
							<li>
								<a href="components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
							</li>
						</ul>
					</li>
					
					<li class='dropdown language-select'>
						<a href="javascript:void(0);" class='dropdown-toggle' data-toggle="dropdown">
							<?php if($this->Session->read('Config.language') == 'pt'){ ?>
							<div><?php echo $this->Html->image('demo/flags/pt.gif'); ?><span><?php echo __('Portuguese'); ?></span></div>
							<?php } else { ?> 
							<div><?php echo $this->Html->image('demo/flags/us.gif'); ?><span><?php echo __('English'); ?></span></div>
							<?php } ?>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo $this->Html->url(array('plugin'=>false,'controller'=>'pages','action'=>'language','pt'),true); ?>"  class='langlink'>
								<?php echo $this->Html->image('demo/flags/pt.gif'); ?>
								<span><?php echo __('Portuguese'); ?></span></a>
							</li>
							<li>
								<a href="<?php echo $this->Html->url(array('plugin'=>false,'controller'=>'pages','action'=>'language','en'),true); ?>" class='langlink'>
								<?php echo $this->Html->image('demo/flags/us.gif'); ?>
								<span><?php echo __('English'); ?></span></a>
							</li>
							
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<a href="javascript:void(0);" class='dropdown-toggle' data-toggle="dropdown"><?php echo __('Welcome'); ?> <?php echo $AdminData['username'];?>
					</a>
					<ul class="dropdown-menu pull-right">
						<li>
						<?php echo $this->Html->link(__('Account settings'),array('plugin'=>false,'controller'=>'users','action'=>'myaccount'),array('escape'=>false)); ?>
							
						</li>
						<li>
							<?php echo $this->Html->link(__('Sign Out'),array('plugin'=>false,'controller'=>'users','action'=>'logout'),array('escape'=>false)); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>