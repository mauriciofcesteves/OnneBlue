<div class="row show-grid">
	<div class="col-lg-12">
		<h2 class="text-center small-vertical-space"><?php echo __('Users'); ?></h2>
		<div class="row">
			<div class="col-sm-7">
				<div class="btn-group">
					<?php 
					echo $this->Html->link(__('%s Add%s', '<i class="fa fa-plus"></i><span class="hidden-xs">', '</span>'), 
						array(
							'action' => 'add'
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
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php echo $this->element('search_init'); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo $this->Paginator->sort('email'); ?></th>
					<th class="visible-lg visible-md"><?php echo $this->Paginator->sort('group_id'); ?></th>
					<?php echo $this->element('admin-actions-title'); ?>
				</tr>
			</thead>
			<tbody>
				<?php 
				echo $this->element('search_fields',
					array(
						'fields' => array(
							'email' => array('class' => 'form-control'),
							'group_id' => array('options' => $groups, 'class' => 'has-select2', 'hide' => 'visible-lg visible-md'),
						)
					)
				);
				foreach ($users as $user) { ?>
				<tr>
					<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
					<td class="visible-lg visible-md">
						<?php
							if($globalPermissions['@core']['groups']['admin_view']['active'] == '1') {
								echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); 
							} else {
								echo $user['Group']['name'];
							}
						?>
					</td>
					<?php echo $this->element('admin-actions', array('id' => $user['User']['id'])); ?>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php echo $this->element('paginator'); ?>
	</div>
</div>