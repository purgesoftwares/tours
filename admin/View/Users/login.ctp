
<h1>
	<?php echo $this->Html->link($this->Html->image('logo1.jpg',array('class'=>'retina-ready')),array('controller'=>'/'),array('escape'=>false)); ?>
</h1>
	
<p> <?php 
			if(isset($_SESSION['failed'])){
				?>
				
				<div class="row-fluid margin-top alert-message">
					<div class="span12">
						<div class="alert alert-info">
						<a class="close" href="javascript:void(0)">×</a>
							<?php echo $_SESSION['failed'];?>
						</div>
					</div>
				</div>
				<?php
				unset($_SESSION['failed']);
			}	
 echo $this->Session->flash(); ?>
		
</p>

		<div class="login-body">
		
			<h2><?php echo __('Welcome!'); ?></h2>
			<p><?php echo __('Login using the email address and password.'); ?></p>
			<?php
				echo $this->Form->create($model, array(
										'action' => 'login',
										'class' => 'form-validate','id'=>'test'));
			?>
				<div class="control-group">
					<div class="text controls">
						<?php echo $this->Form->text('email',array('class'=>'input-block-level','placeholder'=>__('Email address'),'data-rule-required'=>true,'data-rule-email'=>true,'data-rule-text'=>true)); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="text controls">
						<?php echo $this->Form->password('password',array('class'=>'input-block-level','placeholder'=>__('Password'),'data-rule-required'=>true)); ?>
					</div>
				</div>
				<div class="submit">
					<div class="remember">
						<?php echo $this->Form->checkbox('remember_me',array('class'=>'icheck-me','data-skin'=>'square','data-color'=>'blue','id'=>'remember')); ?>
						<label for="remember"><?php echo __('Remember me'); ?></label>
					</div>
					<input type="submit" value="<?php echo __('Sign me in'); ?>" class='btn btn-primary'>
				</div>
			<?php echo $this->form->end(); ?>
			<div class="forget">
				<a href="<?php echo $this->Html->url(array('plugin'=>false,'controller'=>'users','action'=>'forgot_password'),true); ?>"><span><?php echo __('Forgot password').'?'; ?></span></a>
			</div>
		</div>