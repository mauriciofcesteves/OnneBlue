<tr class="info">
	<?php 
		if (empty($form)) {
			$form = 'SearchAdminIndexForm';
		}
	?>

	<?php
	foreach ($fields as $key => $value) {
		$formOptions = array('label' => false);
		if (is_array($value)) {
			$name = $key;
		} else {
			$name = $value;
			if (!$name) {
				$name = false;
			}
		}

		if (isset($value['type'])) { 
			$formOptions['type'] = $value['type']; 
		}
		if (isset($value['id'])) { 
			$formOptions['id'] = $value['id']; 
		}
		if (isset($value['options'])) { 
			$formOptions['options'] = $value['options']; 
		}
		if (isset($value['class'])) {
			$formOptions['class'] = $value['class'];
		}
		if (isset($value['hide'])) {
			$formOptions['hide'] = 'class="'.$value['hide'].'"';
		} else {
			$formOptions['hide'] = '';
		}
		if (isset($search[$name])) {
			$formOptions['value'] = $search[$name];
		}
		if (isset($value['disabled'])) {
			$formOptions['disabled'] = 'disabled';
		}

		//se o campo tiver a palavra 'disabled'
		if (!$name) {
			//entao desabilita o campo no formulario
			$formOptions['disabled'] = 'disabled';
		}
		echo '<td '.$formOptions['hide'].'>' . $this->Form->input($name, $formOptions) . '</td>';
	}
	?>
	<td class="actions">
		<div class="btn-group btn-group-justified">
		<?php 
		echo $this->Html->link(__('%s Search%s', '<i class="fa fa-search"></i><span class="hidden-xs">', '</span>'), 'javascript:'.$form.'.submit();',
			array(
				'class' => 'btn btn-default',
				'div' => false,
				'escape' => false,
			)
		);
		echo $this->Html->link(__('%s Reset%s', '<i class="fa fa-undo"></i><span class="hidden-xs">', '</span>'),
			array(
				'controller' => $this->params['controller']
			),
			array(
				'class' => 'btn btn-default',
				'escape' => false,
			)
		);
		echo $this->Form->end();
		?>
	</div>
	</td>
</tr>