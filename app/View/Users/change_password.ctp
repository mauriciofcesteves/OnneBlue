<?php echo $this->Html->script('pwstrength', array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        "use strict";
        var options = {};
        options.ui = {
            container: "#pwd-container",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pwstrength_viewport_progress"
            }
        };
        options.common = {
            debug: true,
            onLoad: function () {
                $('#messages').text('Start typing password');
            }
        };
        $('#password').pwstrength(options);
    });
</script>
<div class="row">
	<div class="col-lg-12">
		<h3 class="subheader text-center"><?php echo __('Change Password'); ?></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
		<div class="panel panel-default">
            <div class="panel-body">
			<?php 
			echo $this->Form->create('User', array('novalidate'));
			echo $this->Form->input(
				'password', array(
					'class' => 'form-control strength',
					'div' => 'form-group',
					'label' => __('New Password'),
					'id' => 'password',
					'placeholder' => __('Use at least 6 characters')
				)
			);
            echo $this->Form->input(
                'repassword', array(
                    'type' => 'password',
                    'class' => 'form-control',
                    'div' => 'form-group',
                    'placeholder' => __('Repeat the new password'),
                    'label' => __('Confirm New Password')
                )
            );
            ?>
            <div class="row" id="pwd-container">
                <div class="col-lg-12">
                    <div class="pwstrength_viewport_progress"></div>
                </div>
            </div>
            <?php
			echo $this->Form->submit(__('Save password'), 
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