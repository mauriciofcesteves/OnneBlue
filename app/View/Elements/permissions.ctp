<div class="hs-header">
	<h2 class="text-center small-vertical-space"><?php echo __('Permissions'); ?></h2>
</div>
<fieldset class="panel panel-default">
	<div class="panel-body">
		<legend><?php echo __('General'); ?></legend>

		<div id="permissions" class="row">
			<?php
			foreach ($permissions['@core'] as $controllerPermissionKey => $controllerPermissionValue) {
				if (isset($controllerPermissionValue['root']['show']) === true
					&& $controllerPermissionValue['root']['show'] === '0'
					|| $controllerPermissionKey === 'root'
				) {
					continue;
				}//end if
				?>
				<div class="col-lg-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th colspan="2">
									<?php
									if ($controllerPermissionValue['root']['name'] !== null) {
										echo __($controllerPermissionValue['root']['name']);
									} else {
										echo __(Inflector::humanize(Inflector::underscore($controllerPermissionKey)));
									}
									?>
									<br><small><?php echo $controllerPermissionValue['root']['description']; ?></small>
								</th>
							</tr>
						</thead>
						<?php
						foreach ($controllerPermissionValue as $actionPermissionKey => $actionPermissionValue) {
						if ((isset($actionPermissionValue['show']) === true && $actionPermissionValue['show'] === '0')
							|| $actionPermissionKey === 'show'
							|| $actionPermissionKey === 'root'
						) {
							continue;
						}
						$checked = '';
						$value   = '';
						if (isset($actionPermissionValue['active']) === true
							&& $actionPermissionValue['active'] === true
							&& isset($add) === false
						) {
							$checked = 'checked';
							$value   = 'value="1"';
						}
						?>
							<tr>
								<td class="col-xs-8 col-sm-9">
									<?php
									if ($actionPermissionValue['name'] !== null) {
										echo __($actionPermissionValue['name']);
									} else {
										echo __(Inflector::humanize($actionPermissionKey));
									}
									?>
									<br><small><?php echo $actionPermissionValue['description']; ?></small>
								</td>
								<td class="col-xs-4 col-sm-3">
									<?php
									if (isset($view) === true && $view === true) {
										if ($checked === 'checked') {
											echo '<div class="permission-on">ON</div>';
										} else {
											echo '<div class="permission-off">OFF</div>';
										}
									} else if (isset($sync) === true && $sync === true) {
										echo '<div class="permission-updated"><i class="fa fa-check fa-2x"></i></div>';
									} else {
									?>
									<input type="hidden" name="data[Group][aco][<?php echo 'controllers/'.Inflector::camelize($controllerPermissionKey).'/'.$actionPermissionKey; ?>]" value="0" />
									<input type="checkbox" name="data[Group][aco][<?php echo 'controllers/'.Inflector::camelize($controllerPermissionKey).'/'.$actionPermissionKey; ?>]" class="bootstrap-switch" <?php echo $checked.' '.$value; ?>>
									<?php } ?>
								</td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
				<?php
			}
			?>
		</div>

		<?php
		unset($permissions['@plugin']['Headquarters']);
		foreach ($permissions['@plugin'] as $pluginKey => $pluginValue) {
		?>
		<legend><?php echo __(Inflector::humanize(Inflector::underscore($pluginKey))); ?></legend>

		<div id="permissions" class="row">
			<?php
			foreach ($pluginValue as $controllerPermissionKey => $controllerPermissionValue) {
				if (isset($controllerPermissionValue['root']['show']) === true
					&& $controllerPermissionValue['root']['show'] === '0'
					|| $controllerPermissionKey === 'root'
				) {
					continue;
				}//end if
				?>
				<div class="col-lg-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th colspan="2">
									<?php
									if ($controllerPermissionValue['root']['name'] !== null) {
										echo __($controllerPermissionValue['root']['name']);
									} else {
										echo __(Inflector::humanize(Inflector::humanize($controllerPermissionKey)));
									}
									?>
									<br><small><?php echo $controllerPermissionValue['root']['description']; ?></small>
								</th>
							</tr>
						</thead>
						<?php
						foreach ($controllerPermissionValue as $actionPermissionKey => $actionPermissionValue) {
						if ((isset($actionPermissionValue['show']) === true && $actionPermissionValue['show'] === '0')
							|| $actionPermissionKey === 'show'
							|| $actionPermissionKey === 'root'
						) {
							continue;
						}
						$checked = '';
						$value   = '';
						if (isset($actionPermissionValue['active']) === true
							&& $actionPermissionValue['active'] === true
							&& isset($add) === false
						) {
							$checked = 'checked';
							$value   = 'value="1"';
						}
						?>
							<tr>
								<td class="col-xs-8 col-sm-9">
									<?php
									if ($actionPermissionValue['name'] !== null) {
										echo __($actionPermissionValue['name']);
									} else {
										echo __(Inflector::humanize($actionPermissionKey));
									}
									?>
									<br><small><?php echo $actionPermissionValue['description']; ?></small>
								</td>
								<td class="col-xs-4 col-sm-3">
									<?php
									if (isset($view) === true && $view === true) {
										if ($checked === 'checked') {
											echo '<div class="permission-on">ON</div>';
										} else {
											echo '<div class="permission-off">OFF</div>';
										}
									} else if (isset($sync) === true && $sync === true) {
										echo '<div class="permission-updated"><i class="fa fa-check fa-2x"></i></div>';
									} else {
									?>
									<input type="hidden" name="data[Group][aco][<?php echo 'controllers/'.$pluginKey.'/'.Inflector::camelize($controllerPermissionKey).'/'.$actionPermissionKey; ?>]" value="0" />
									<input type="checkbox" name="data[Group][aco][<?php echo 'controllers/'.$pluginKey.'/'.Inflector::camelize($controllerPermissionKey).'/'.$actionPermissionKey; ?>]" class="bootstrap-switch" <?php echo $checked.' '.$value; ?>>
									<?php } ?>
								</td>
							</tr>
						<?php
						}
						?>
					</table>
				</div>
				<?php
			}
			?>
		</div>
		<?php } ?>

	</div>
</fieldset>