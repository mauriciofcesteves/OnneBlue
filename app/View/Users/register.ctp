<?php
echo $this->Html->script('pwstrength', array('inline' => false));
echo $this->Html->css('captcha', array('inline' => false));
$mode = Configure::read('MyApp.mode');
?>
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
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mid-vertical-space text-center uppercase"><?php echo __('Start using it today'); ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-7 col-sm-9 center-block">
            <div class="panel panel-default">
                <?php echo $this->Form->create('User', array('id' => 'FormRegister', 'url' => array('action' => 'register'), 'novalidate')); ?>
                <div class="panel-body">
                    <h3 class="text-center"><?php echo __('Change your business'); ?></h3>
                    <?php if (Configure::read('MyApp.mode') !== 'beta') { ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input(
                                'first_name', array(
                                    'class' => 'form-control',
                                    'div' => 'form-group',
                                )
                            );
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input(
                                'last_name', array(
                                    'class' => 'form-control',
                                    'div' => 'form-group',
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            echo $this->Form->input(
                                'email', array(
                                    'autocomplete' => 'off',
                                    'class' => 'form-control',
                                    'div' => 'form-group',
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <?php if (Configure::read('MyApp.mode') !== 'beta') { ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            echo $this->Form->input(
                                'password', array(
                                    'class' => 'form-control strength',
                                    'id' => 'password',
                                    'div' => 'form-group',
                                    'placeholder' => __('Use at least 6 characters')
                                )
                            );
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            echo $this->Form->input(
                                'repassword', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'div' => 'form-group',
                                    'placeholder' => __('Repeat the password please'),
                                    'label' => __('Confirm Password')
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
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $this->element('recaptcha', array('publickey' => $publickey)); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="term-alert">
                                <?php
                                $termOfUser = $this->Html->link(__('Term of Use'), '#',
                                    array(
                                        'data-toggle' => 'modal',
                                        'data-target' => '#open-term-of-use-modal',
                                    )
                                );
                                if (Configure::read('MyApp.mode') !== 'beta') {
                                    echo __('By clicking the button below, you agree to the %s', $termOfUser);
                                }
                                ?>
                            </p>
                            <?php
                            if (Configure::read('MyApp.mode') !== 'beta') {
                                echo $this->Form->submit(__('Create my account'), 
                                    array(
                                        'class' => 'btn btn-success btn-block',
                                        'type' => 'submit',
                                        'div' => 'form-group',
                                    )
                                );
                            } else {
                                echo $this->Form->submit(__('Do my pre-register'), 
                                    array(
                                        'class' => 'btn btn-success btn-block',
                                        'type' => 'submit',
                                        'div' => 'form-group',
                                    )
                                );
                            }
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="kv-meter-container"></div>

<!-- Modal -->
<div class="modal fade" id="open-term-of-use-modal" tabindex="-1" role="dialog" aria-labelledby="term-of-use-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo __('Close'); ?></span></button>
                <h4 class="modal-title" id="term-of-use-modal"><?php echo __('Term of Use'); ?></h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs no-margin" data-dismiss="modal"><?php echo __('Close'); ?></button>
            </div>
        </div>
    </div>
</div>