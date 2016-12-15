<div class="row show-grid">
	<div class="col-lg-7 col-md-9">
		<h2 class="text-center small-vertical-space"><?php echo __('View User'); ?></h2>
		<?php echo $this->element('view-buttons', array('id' => $user['User']['id'])); ?>
	</div>
</div>

<div class="row view">
	<div class="col-lg-12">
		<table class="table table-striped">
			<tr>
				<th width="14%"><?php echo __('Name'); ?></th>
				<td>
					<?php echo h($user['User']['name']); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Email'); ?></th>
				<td>
					<?php echo h($user['User']['email']); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Group'); ?></th>
				<td>
					<?php 
					if($globalPermissions['@permission']['groups']['admin_view']['active'] == '1') {
						echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id']));
					} else {
						echo $user['Group']['name'];
					}
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Created'); ?></th>
				<td>
					<?php echo h($user['User']['created']); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Modified'); ?></th>
				<td>
					<?php echo h($user['User']['modified']); ?>
				</td>
			</tr>
		</table>

		<?php
		echo $this->Html->link(__('%s Back%s', '<i class="fa fa-arrow-left"></i><span class="hidden-xs">', '</span>'), 
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
