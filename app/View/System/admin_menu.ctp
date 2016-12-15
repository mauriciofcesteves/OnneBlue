<div class="row show-grid">
	<div class="col-lg-12">
		<?php 
		echo $this->Form->create('Aco', array('novalidate'));
		?>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('System Menu'); ?></legend>
					<div class="row">
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><?php echo __('Original Name'); ?></th>
										<th><?php echo __('Custom Name'); ?></th>
										<th width="20%"><?php echo __('Active'); ?></th>
									</tr>
								</thead>
								<tbody>
							<?php 
							foreach ($menu as $menuValue) { 
								$switchChecked = '';
								$value = '';
								if ($menuValue['Aco']['parent_id'] == 1) {
									if ($menuValue['Aco']['active']) {
										$switchChecked = 'checked';
										$value = 'value="1"';
									}
							?>
									<tr>
										<td><b><?php echo __($menuValue['Aco']['alias']); ?></b></td>
										<td>
											<?php 
											echo $this->Form->hidden($menuValue['Aco']['id'] . '.Aco.id',
												array(
													'value' => $menuValue['Aco']['id']
												)
											);
											echo $this->Form->input($menuValue['Aco']['id'] . '.Aco.name',
												array(
													'label' => false,
													'value' => $menuValue['Aco']['name'],
													'class' => 'form-control'
												)
											); 
											?>
										</td>
										<td>
											<input type="checkbox" name="data[<?php echo $menuValue['Aco']['id']; ?>][Aco][active]" class="bootstrap-switch" <?php echo $switchChecked . ' ' . $value;  ?> >
										</td>
									</tr>
									<?php
										foreach ($menu as $subMenuValue) {
											$_switchChecked = '';
											$_value = 'value="0"';
											if ($menuValue['Aco']['id'] == $subMenuValue['Aco']['parent_id']) {
												if ($subMenuValue['Aco']['active']) {
													$_switchChecked = 'checked';
													$_value = 'value="1"';
												}
												?>
												<tr>
													<td><?php echo __(Inflector::humanize($subMenuValue['Aco']['alias'])); ?></td>
													<td>
														<?php 
														echo $this->Form->hidden($subMenuValue['Aco']['id'] . '.Aco.id',
															array(
																'value' => $subMenuValue['Aco']['id']
															)
														);
														echo $this->Form->input($subMenuValue['Aco']['id'] . '.Aco.name',
															array(
																'label' => false,
																'value' => $subMenuValue['Aco']['name'],
																'class' => 'form-control'
															)
														);
														?>
													</td>
													<td>
														<input type="checkbox" name="data[<?php echo $subMenuValue['Aco']['id']; ?>][Aco][active]" class="bootstrap-switch" <?php echo $_switchChecked . ' ' . $_value;  ?> >
													</td>
												</tr>
												<?php
											}
										}
									}
									?>
							<?php } ?>
								</tbody>
							</table>
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
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>