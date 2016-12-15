<div class="row show-grid">
	<div class="col-lg-12">
		<h2 class="text-center small-vertical-space"><?php echo __('Edit Group'); ?></h2>
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
		echo $this->Form->create('Group', array('novalidate')); 
		echo $this->Form->input('id');
		?>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Admin Add Group'); ?></legend>
					<?php
					echo $this->Form->input('name', 
						array(
							'class' => 'form-control autofocus',
							'div' => array('class' => 'form-group')
						)
					);
					?>
				</div>
			</fieldset>

			<?php 
			echo $this->element('permissions'); 
			?>

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