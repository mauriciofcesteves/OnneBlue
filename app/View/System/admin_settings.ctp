<div class="row show-grid">
	<div class="col-lg-12">
		<?php 
		echo $this->Form->create('System', array('novalidate')); 
		?>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('System Settings'); ?></legend>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?php
								echo $this->Form->input('default_group',
									array(
										'selected' => $defaultGroup,
										'label' => __('Create Account (Default Group)'),
										'options' => $groups
									)
								);
							?>
						</div>
						<div class="col-lg-6 col-md-6">
						</div>
					</div>
				</div>
			</fieldset>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<?php 
					echo $this->Form->submit(__('Save'), 
						array(
							'class' => 'btn btn-primary'
						)
					);
					?>
				</div>
				<div class="col-lg-6 col-md-6">
					<span class="required-text"><?php echo __('indicates a required field'); ?></span>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>