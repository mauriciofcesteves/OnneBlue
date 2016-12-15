<?php
$disabled = false;
if ($group['Group']['id'] == 1) {
	$disabled = true;
}
?>
<div class="row show-grid">
	<div class="col-lg-7 col-md-9">
		<h2 class="text-center small-vertical-space"><?php echo __('View Group'); ?></h2>
		<?php echo $this->element('view-buttons', array('id' => $group['Group']['id'])); ?>
	</div>
</div>

<div class="row view">
	<div class="col-lg-12">
		<table class="table table-striped table-curved">
			<tr>
				<th class="col-sm-2 col-md-2"><?php echo __('Name'); ?></th>
				<td>
					<?php echo h($group['Group']['name']); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Created'); ?></th>
				<td>
					<?php echo h($group['Group']['created']); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo __('Modified'); ?></th>
				<td>
					<?php echo h($group['Group']['modified']); ?>
				</td>
			</tr>
		</table>

		<?php
		echo $this->element('permissions', array('view' => true));
		
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