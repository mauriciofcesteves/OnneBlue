<div class="row show-grid">
	<div class="col-lg-12">	
		<h2 class="text-center small-vertical-space"><?php echo __('Groups'); ?></h2>
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
					<th><?php echo $this->Paginator->sort('name'); ?></th>
					<?php echo $this->element('admin-actions-title'); ?>
				</tr>
			</thead>
			<tbody>
				<?php 
				echo $this->element('search_fields',
					array(
						'fields' => array(
							'name' => array('class' => 'form-control'),
						)
					)
				);
				foreach ($groups as $group) { ?>
				<tr>
					<td><?php echo h($group['Group']['name']); ?></td>
					<?php echo $this->element('admin-actions', array('id' => $group['Group']['id'])); ?>
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