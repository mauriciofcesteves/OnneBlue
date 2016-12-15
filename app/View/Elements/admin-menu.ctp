<nav class="navbar navbar-top navbar-fixed-top navbar-white has-center-logo" role="navigation">
	<div class="container-fluid">
		<div id="navbar">
			<div class="navbar-header">
				<?php
				echo $this->Html->link("<i class='fa fa-reorder'></i>", '#',
					array(
						'class' => 'navbar-toggle navbar-brand',
						'escape' => false,
						'data-toggle' => 'collapse',
						'data-target' => '#erp-main-app'
					)
				);
				?>
			</div>
			<div id="onneblue-icon-fixed">
				<?php
				echo $this->Html->link('',
					array(
						'controller' => 'dashboard',
						'action' => 'index',
						'admin' => true,
						'plugin' => false
					),
					array(
						'escape' => false
					)
				);
				?>
			</div>

			<div class="collapse navbar-collapse margin-top-visible-xs" id="erp-main-app">
				<ul class="nav navbar-nav navbar-left">
					<?php
					if ($this->Harvest->hasPermission('users', 'admin_index') === true) {
					?>
					<li class="dropdown">
						<?php
						echo $this->Html->link(__('Users %s', '<b class="caret"></b>'), '#',
							array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
								'escape' => false
							)
						);
						?>
						<ul class="dropdown-menu">
							<li>
								<?php 
								echo $this->Harvest->link(__('List %s', '<i class="fa fa-list"></i>'), 
									array(
										'controller' => 'users', 
										'action' => 'index', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								echo $this->Harvest->link(__('Add %s', '<i class="fa fa-plus"></i>'), 
									array(
										'controller' => 'users', 
										'action' => 'add', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								?>
							</li>
						</ul>
					</li>
					<?php
					}
					if ($this->Harvest->hasPermission('groups', 'admin_index') === true) {
					?>
					<li class="dropdown">
						<?php
						echo $this->Html->link(__('Groups %s', '<b class="caret"></b>'), '#',
							array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
								'escape' => false
							)
						);
						?>
						<ul class="dropdown-menu">
							<li>
								<?php 
								echo $this->Harvest->link(__('List %s', '<i class="fa fa-list"></i>'), 
									array(
										'controller' => 'groups', 
										'action' => 'index', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								echo $this->Harvest->link(__('Add %s', '<i class="fa fa-plus"></i>'), 
									array(
										'controller' => 'groups', 
										'action' => 'add', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								?>
							</li>
						</ul>
					</li>
					<?php } ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
                	<?php echo $this->element('language'); ?>
					<li class="divider-vertical"></li>
					<?php echo $this->element('notifications/menu'); ?>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<?php
						echo $this->Html->link(__('%s %s', $userData['name'], '<b class="caret"></b>'), '#',
							array(
								'class' => 'dropdown-toggle',
								'data-toggle' => 'dropdown',
								'escape' => false
							)
						);
						?>
						<ul class="dropdown-menu">
							<?php if($globalPermissions['@core']['users']['admin_account']) { ?>
							<li>
								<?php 
								echo $this->Html->link(__('Account %s', '<i class="fa fa-user"></i>'), 
									array(
										'controller' => 'users', 
										'action' => 'account', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								?>
							</li>
							<?php } ?>
							<li>
								<?php 
								echo $this->Html->link(__('Plans %s', '<i class="fa fa-money"></i>'), 
									array(
										'controller' => 'plans', 
										'action' => 'index', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								?>
							</li>
							<li class="divider"></li>
							<li>
								<?php 
								echo $this->Html->link(__('Logout %s', '<i class="fa fa-power-off"></i>'), 
									array(
										'controller' => 'users', 
										'action' => 'logout', 
										'admin' => true,
										'plugin' => false
									),
									array('escape' => false)
								);
								?>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>