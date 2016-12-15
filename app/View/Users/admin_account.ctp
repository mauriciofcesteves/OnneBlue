<?php echo $this->Html->script('pwstrength', array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        "use strict";
        var options = {};
        options.ui = {
            container: "#pwd-container",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pwstrength_viewport_progress"
            }
        };
        options.common = {
            debug: true,
            onLoad: function () {
                $('#messages').text('Start typing password');
            }
        };
        $('#password').pwstrength(options);
    });
</script>
<div class="row show-grid">
	<div class="col-lg-12">
        <h2 class="text-center small-vertical-space"><?php echo __('Account'); ?></h2>
	</div>
</div>

<div class="row show-grid">
	<div class="col-lg-12">
		<?php 
		echo $this->Form->create('User', array('novalidate')); 
		echo $this->Form->input('id');
		?>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Personal details'); ?></legend>
					<div class="row">
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('first_name',
									array(
										'class' => 'form-control',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('last_name',
									array(
										'class' => 'form-control',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Login details'); ?></legend>
					<div class="row">
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('email',
									array(
										'class' => 'form-control',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
	      				<div class="col-sm-6">
							<?php
								echo $this->Form->input('password',
									array(
										'placeholder' => __('Current password'),
										'class' => 'form-control',
										'div' => array('class' => 'form-group')
									)
								);
							?>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset class="panel panel-default">
				<div class="panel-body">
					<legend><?php echo __('Security'); ?></legend>
					<div class="row">
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input(
                                'newpass', array(
                                    'type' => 'password',
                                    'class' => 'form-control strength',
                                    'div' => 'form-group',
                                    'id' => 'password',
                                    'placeholder' => __('Leave blank if you do not want to change'),
                                    'label' => __('New Password')
                                )
                            );
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input(
                                'newrepass', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'div' => 'form-group',
                                    'label' => __('Confirm New Password')
                                )
                            );
                            ?>
                        </div>
					</div>
                    <div class="row" id="pwd-container">
                        <div class="col-lg-12">
                            <div class="pwstrength_viewport_progress"></div>
                        </div>
                    </div>
					<?php echo __('We will never ask for your password. Always use strong passwords and change them frequently.'); ?>
				</div>
			</fieldset>
            <fieldset class="panel panel-default">
                <div class="panel-body">
                    <legend><?php echo __('Transactions'); ?></legend>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (empty($transactions) === true) { ?>
                                <div class="alert alert-info text-center">
                                    <i class="fa fa-exclamation-triangle fa-5x"></i>
                                    <p><?php echo __('No transaction was conducted'); ?></p>
                                </div>
                            <?php } else { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo __('Date'); ?></th>
                                        <th><?php echo __('Product'); ?></th>
                                        <th><?php echo __('Period'); ?></th>
                                        <th><?php echo __('Price'); ?></th>
                                        <th><?php echo __('Status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transactions as $transactionKey => $transactionValue) { ?>                                 
                                    <tr>
                                        <td><?php echo $transactionValue['Transaction']['created']; ?></td>
                                        <td>OnneBlue <?php echo $transactionValue['Plan']['name']; ?></td>
                                        <td><?php echo __(Inflector::humanize($transactionValue['Transaction']['period'])); ?></td>
                                        <td><?php echo $transactionValue['Transaction']['price']; ?></td>
                                        <td><?php echo $this->Harvest->PagSeguroStatus($transactionValue['Transaction']['status']); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php
                                if (count($transactions) > 4) {
                                    echo $this->Html->link(__('See all transactions'),
                                        array(
                                            'controller' => 'transactions',
                                            'action' => 'index',
                                            'admin' => true
                                        ),
                                        array(
                                            'class' => 'btn btn-primary'
                                        )
                                    );
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </fieldset>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<?php 
					echo $this->Form->button(__('%s Save%s', '<i class="fa fa-floppy-o"></i><span class="hidden-xs">', '</span>'), 
						array(
							'type' => 'submit',
							'class' => 'btn btn-success',
							'div' => false
						)
					);
					echo $this->Form->end();
					?>
					<?php
					echo $this->Form->postLink(__('%s Cancel%s', '<i class="fa fa-times"></i><span class="hidden-xs">', '</span>'), 
						array(
                            'controller' => 'dashboard',
							'action' => 'index',
                            'admin' => true
						), 
						array(
							'class' => 'btn btn-danger cancel',
							'escape' => false
						),
						__('Are you sure you want to cancel editing the %s?', __(Inflector::singularize(Inflector::humanize($this->params['controller']))))
					);
					?>
				</div>
      			<div class="col-lg-6 col-md-6">
					<span class="required-text"><i class="fa fa-asterisk"></i> <?php echo __('indicates a required field'); ?></span>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

<div class="kv-meter-container"></div>