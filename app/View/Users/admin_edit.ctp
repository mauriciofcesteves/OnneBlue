<?php echo $this->Html->script('dinamic_select', array('inline' => false)); ?>
<script type="text/javascript">
$(document).ready(function() {
    dinamic_select('groups_select', 'groups_select_init', 'Group', 'groups', lang.selectGroup, false, '../');
});
</script>
<div class="row show-grid">
	<div class="col-lg-12">
		<h2 class="text-center small-vertical-space"><?php echo __('Edit User'); ?></h2>
		<div class="btn-group">
			<?php 
			echo $this->Html->link(__('%s List%s', '<i class="fa fa-list"></i><span class="hidden-xs">', '</span>'), 
				array(
					'action' => 'index'
				), 
				array(
					'class' => 'btn btn-primary',
					'escape' => false
				)
			); 
			?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php 
		echo $this->Form->create('User', array('novalidate')); 
		echo $this->Form->input('id');
		?>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Personal Details'); ?></legend>
					<div class="row">
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('first_name',
									array(
										'label' => __('First Name'),
										'class' => 'form-control autofocus',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('last_name',
									array(
										'label' => __('Last Name'),
										'class' => 'form-control',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Login Details'); ?></legend>
					<div class="row">
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('email',
									array(
										'label' => __('Email'),
										'class' => 'form-control',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('password',
									array(
										'placeholder' => __('Type a strong password'),
										'class' => 'form-control strength',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
					</div>
					<div class="row">
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input(
                                'repassword', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'div' => 'form-group',
                                    'placeholder' => __('Repeat the password please'),
                                    'label' => __('Confirm Password')
                                )
                            );
                            ?>
                        </div>
					</div>
				</div>
			</fieldset>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Group Belonging'); ?></legend>
					<div class="row">
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('group_id',
									array(
										'empty' => array(' ' => __('Select an option')),
										'div' => array('class' => 'form-group'),
										'id' => 'groups_select',
										'type' => 'text'
									)
								);
							?>
						</div>
					</div>
				</div>
			</fieldset>

			<div class="row">
				<div class="col-sm-6">
					<?php 
					echo $this->Form->button(__('%s Save%s', '<i class="fa fa-floppy-o"></i><span class="hidden-xs">', '</span>'),
						array(
							'type' => 'submit',
							'class' => 'btn btn-success',
							'div' => false,
							'escape' => false
						)
					);
					echo $this->Form->end();
					?>
					<?php
					echo $this->Form->postLink(__('%s Cancel%s', '<i class="fa fa-times"></i><span class="hidden-xs">', '</span>'), 
						array(
							'action' => 'index',
						), 
						array(
							'class' => 'btn btn-danger cancel',
							'escape' => false
						),
						__('Are you sure you want to cancel editing the %s?', Inflector::singularize(Inflector::humanize($this->params['controller'])))
					);
					?>
				</div>
      			<div class="col-sm-6">
					<span class="required-text"><i class="fa fa-asterisk"></i> <?php echo __('indicates a required field'); ?></span>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>