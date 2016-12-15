<?php 
if (isset($this->params['plugin']) === true) {
    $controller = $globalPermissions['@plugin'][Inflector::camelize($this->params['plugin'])][$this->params['controller']];
} else {
    $controller = $globalPermissions['@core'][$this->params['controller']];
}

$userId = $userData['id'];
$groupId = $userData['Group']['id'];
if (isset($entity) === false && empty($entity) === true) {
	$entity = __('the system register');
}
$lockedGroups = array(1, 2, 3, 4);
$disabled = false;

if (($this->params['controller'] === 'users' && ($userId === $id || $id === 1))
	|| ($this->params['controller'] === 'groups' && in_array($id, $lockedGroups) === true)
	|| $this->params['controller'] === 'inputs_outputs'
) {
	$disabled = true;
}

if (
    (isset($controller['admin_view']['active']) === true && $controller['admin_view']['active'] === true) ||
    (isset($controller['admin_edit']['active']) === true && $controller['admin_edit']['active'] === true) ||
    (isset($controller['admin_delete']['active']) === true && $controller['admin_delete']['active'] === true)
) { 
	?>
	<td class="actions">
		<div class="btn-group btn-group-justified">
		<?php 
		echo $this->Html->link(__('<i class="fa fa-eye"></i>'), 
			array(
				'action' => 'view', 
				$id
			),
			array(
				'class' => 'btn btn-primary',
				'escape' => false
			)
		);
		if (!$disabled) {
			echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), 
				array(
					'action' => 'edit', 
					$id
				),
				array(
					'class' => 'btn btn-primary',
					'escape' => false
				)
			);
			if ($controller['admin_delete']) {
				echo $this->Form->postLink(__('<i class="fa fa-trash-o"></i>'), 
					array(
						'action' => 'delete', 
						$id
					), 
					array(
						'class' => 'btn btn-danger',
						'escape' => false, 
					),
					__('Are you sure you want to delete %s?', $entity)
				);
			}
		}
		?>
		</div>
	</td>
<?php } ?>