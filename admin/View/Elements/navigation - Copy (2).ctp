<?php
  $AdminData = array('username'=>'Admin');
  $pc	=	$this->params['plugin'].'/'.$this->params['controller'];	
  $dashboardclass		=	'';
  $userclass			=	'';
  $catclass				=	'';

  if(in_array($pc,array('/pages'))){
	$dashboardclass	=	'active';
  }else if(in_array($pc,array('usermgmt/customers','usermgmt/promoters','usermgmt/partners'))){
	$userclass	=	'active';
  }else {
	$catclass	=	'active';
  }
?>
<div class="container">
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
						<span><?php echo __('Setting'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<?php echo $this->Html->link(__('Brands'),array('plugin'=>'brand','controller'=>'brands','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Blog Category'); ?></a>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link(__('Blog Category'),array('plugin'=>'blogcategory','controller'=>'blogcategories','action'=>'index'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Blog Sub Category'),array('plugin'=>'blogcategory','controller'=>'blog_sub_categories','action'=>'index'),array('escape'=>false)); ?>
								</li>
							</ul>
						</li>
						<li class=''>
								<?php echo $this->Html->link(__('Store'),array('plugin'=>'store','controller'=>'stores','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Campaigns'),array('plugin'=>'campaign','controller'=>'campaigns','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Highlights'),array('plugin'=>'campaign','controller'=>'campaigns','action'=>'highlight_campaigns'),array('escape'=>false)); ?>
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
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Newsletters'); ?></a>
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
						<li class=''>
								<?php echo $this->Html->link(__('News'),array('plugin'=>'news','controller'=>'news','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Advertisement'); ?></a>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link(__('View Advertisement'),array('plugin'=>'advertisement','controller'=>'advertisements','action'=>'index'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Settings'),array('plugin'=>'advertisement','controller'=>'advertisements','action'=>'settings'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Reports'),array('plugin'=>'advertisement','controller'=>'advertisements','action'=>'reports'),array('escape'=>false)); ?>
								</li>
							</ul>
						</li>
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('CMS'); ?></a>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link(__('Home page hello block'),array('plugin'=>'cms','controller'=>'pages','action'=>'hello_block'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Home page'),array('plugin'=>'cms','controller'=>'pages','action'=>'home'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Who We Are'),array('plugin'=>'cms','controller'=>'pages','action'=>'who_we_are','who_we_are'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Mission'),array('plugin'=>'cms','controller'=>'pages','action'=>'mission','mission'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Social Responsibility'),array('plugin'=>'cms','controller'=>'pages','action'=>'social_responsibility','social_responsibility'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Press Releases'),array('plugin'=>'cms','controller'=>'pages','action'=>'pressreleases','pressreleases'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Contact Us'),array('plugin'=>'cms','controller'=>'pages','action'=>'contacts','contacts'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Recruitments / Jobs'),array('plugin'=>'cms','controller'=>'pages','action'=>'recruitments','recruitments'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('How It Works'),array('plugin'=>'cms','controller'=>'pages','action'=>'how_it_works','how_it_works'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Blog'),array('plugin'=>'cms','controller'=>'pages','action'=>'blog','blog'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('How To Subscribe'),array('plugin'=>'cms','controller'=>'pages','action'=>'how_to_subscribe','how_to_subscribe'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Data Protection'),array('plugin'=>'cms','controller'=>'pages','action'=>'data_protection','data_protection'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Terms & Conditions'),array('plugin'=>'cms','controller'=>'pages','action'=>'terms_and_conditions','terms_and_conditions'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Web Site Map'),array('plugin'=>'cms','controller'=>'pages','action'=>'web_site_map','web_site_map'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Being A Partner'),array('plugin'=>'cms','controller'=>'pages','action'=>'being_a_partner','being_a_partner'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('Pricing'),array('plugin'=>'cms','controller'=>'pages','action'=>'pricing','pricing'),array('escape'=>false)); ?>
								</li>
							</ul>
						</li>
						
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Blog'); ?></a>
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
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Settings'); ?></a>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link(__('Site settings'),array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix','Site'),array('escape'=>false)); ?>
									
								</li>
								<li class='dropdown-submenu'>
										<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Social Settings'); ?></a>
										<ul class="dropdown-menu">
											<li>
												<?php echo $this->Html->link(__('Google'),array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix','Google'),array('escape'=>false)); ?>
												
											</li>
											<li>
												<?php echo $this->Html->link(__('Facebook'),array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'prefix','Facebook'),array('escape'=>false)); ?>
												
											</li>
										</ul>
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
							</ul>
						</li>
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('More'); ?></a>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link(__('Home Page Slider'),array('plugin'=>'album','controller'=>'image_galleries','action'=>'index'),array('escape'=>false)); ?>
								</li>
								
								<li>
									<?php echo $this->Html->link(__('Home Blog Position'),array('plugin' => 'forum', 'controller' => 'forums', 'action' => 'position'),array('escape'=>false)); ?>
								</li>
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
								<li>
									<?php echo $this->Html->link(__('Press Release'),array('plugin' => 'pressrelease', 'controller' => 'pressreleases', 'action' => 'index'),array('escape'=>false)); ?>
								</li>
								
							</ul>
						</li>
						<li class='dropdown-submenu'>
							<a href="javascript:void(0);" data-toggle="dropdown" class='dropdown-toggle'><?php echo __('Voucher'); ?></a>
							<ul class="dropdown-menu">
								<li>
									<?php echo $this->Html->link(__('Partner Voucher'),array('plugin'=>'voucher','controller'=>'vouchers','action'=>'index'),array('escape'=>false)); ?>
								</li>
								<li>
									<?php echo $this->Html->link(__('GooBond Voucher'),array('plugin'=>'goovoucher','controller'=>'goovouchers','action'=>'index'),array('escape'=>false)); ?>
								</li>
							</ul>
						</li>
						<li>
							<?php echo $this->Html->link(__('Recruitment'),array('plugin'=>'recruitment','controller'=>'recruitments','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Template'),array('plugin'=>'request','controller'=>'request_templates','action'=>'index'),array('escape'=>false)); ?>
						</li>
						<li>
							<?php echo $this->Html->link(__('Highlight Setting'),array('plugin'=>'product','controller'=>'products','action'=>'type_of_highlight'),array('escape'=>false)); ?>
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