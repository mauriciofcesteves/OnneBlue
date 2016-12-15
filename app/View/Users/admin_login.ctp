<div class="container-fluid">
    <?php
    echo $this->Html->css('captcha', array('inline' => false));
    if (isset($logged) === true && $logged !== false) {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="subheader text-center"><?php echo __('Hello <b>%s</b>!', $logged['name']); ?></h3>
        </div>
    </div>
    <?php if (isset($menuPermissionsCache['dashboard']['admin_index']) && $menuPermissionsCache['dashboard']['admin_index']) { ?>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="subheader"><small><?php echo __('You are already logged in:'); ?></small></h3>
                    <?php
                    echo $this->Html->link(__('Go to Admin Panel'),
                        array(
                            'action' => 'index',
                            'admin' => true,
                            'controller' => 'dashboard',
                        ),
                        array(
                            'class' => 'btn btn-primary btn-block'
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    } else {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mid-vertical-space text-center uppercase"><?php echo __('Enter OnneBlue'); ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-6 center-block">
            <div class="panel">
                <div class="panel-body">
                    <h3 class="text-center"><?php echo __('Login'); ?></h3>
                    <?php
                    echo $this->Form->create('User', array('id' => 'FormLogin', 'url' => array('action' => 'login', 'admin' => true), 'novalidate'));
                    echo $this->Form->input(
                        'email', array(
                            'class' => 'form-control autofocus' . $stayConnectedRememberMe,
                            'value' => $stayConnectedEmail,
                            'div' => 'form-group',
                            'label' => false,
                            'placeholder' => __('Email'),
                            'title' => 'email',
                        )
                    );
                    echo $this->Form->input(
                        'password', array(
                            'value' => $stayConnectedPassword,
                            'class' => 'form-control',
                            'div' => 'form-group',
                            'label' => false,
                            'placeholder' => __('Password'),
                            'title' => 'password',
                        )
                    );
                    if (isset($publickey) === true) {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $this->element('recaptcha', array('publickey' => $publickey, 'small' => true)); ?>
                        </div>
                    </div>
                    <?php 
                    }
                    echo $this->Form->submit(__('Login'), 
                        array(
                            'class' => 'btn btn-primary btn-block submit',
                            'type' => 'submit',
                            'div' => 'form-group',
                        )
                    );
                    echo $this->Form->input('remember_me', 
                        array(
                            'checked' => $stayConnectedRememberMe,
                            'label' => __('Remember me'),
                            'type' => 'checkbox',
                            'div' => 'form-group checkbox'
                        )
                    );
                    ?>

                    <div class="text-right">
                    <?php
                    echo $this->Html->link(__('Forgot your password?'), 
                        array(
                            'action' => 'forgot_password',
                            'controller' => 'users',
                            'admin' => false,
                        )
                    );
                    ?>
                     | 
                    <?php
                    echo $this->Html->link(__('Register'), 
                        array(
                            'action' => 'register',
                            'controller' => 'users',
                            'admin' => false,
                        )
                    );
                    ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>