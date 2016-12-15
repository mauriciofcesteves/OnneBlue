<div class="row">
	<div class="col-lg-12">
		<h3 class="subheader text-center"><?php echo __('Forgotten your password?'); ?></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo __('Enter your email to create a new password'); ?></div>
            <div class="panel-body">
			<?php 
			echo $this->Form->create('User', array('url' => array('action' => 'forgot_password', 'admin' => false), 'novalidate'));
			echo $this->Form->input(
				'email', array(
					'class' => 'form-control autofocus',
					'div' => 'form-group',
				)
			);
			echo $this->Form->submit(__('Send email'), 
				array(
					'class' => 'btn btn-primary btn-block submit',
					'type' => 'submit',
				)
			);
			echo $this->Form->end(); 
			?>
			</div>
		</div>
	</div>
</div>