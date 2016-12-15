<nav class="navbar navbar-top navbar-fixed-top navbar-white clean" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <?php 
            echo $this->Html->link("<i class='fa fa-reorder'></i>", '#',
                array(
                    'class' => 'navbar-toggle navbar-brand',
                    'escape' => false,
                    'data-toggle' => 'collapse',
                    'data-target' => '#bs-example-navbar-collapse-1'
                )
            );
            echo $this->Html->link("OnneBlue", 
                array(
                    'controller' => 'pages',
                    'action' => 'index',
                    'admin' => false
                ),
                array(
                    'class' => 'navbar-brand onneblue lg',
                    'escape' => false,
                    'title' => __('Home')
                )
            );
            ?>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="divider-vertical"></li>
                <li>
                <?php 
                if (Configure::read('MyApp.mode') !== 'beta') {
                    echo $this->Html->link(__('Prices'),
                        array(
                            'controller' => 'pages',
                            'action' => 'prices',
                            'admin' => false
                        )
                    );
                }
                ?>
                </li>
                <li>
                <?php 
                echo $this->Html->link(__('About'),
                    array(
                        'controller' => 'pages',
                        'action' => 'about',
                        'admin' => false
                    )
                );
                ?>
                </li>
                <li>
                <?php 
                echo $this->Html->link(__('Tour'),
                    array(
                        'controller' => 'pages',
                        'action' => 'tour',
                        'admin' => false
                    )
                );
                ?>
                </li>
                <li>
                <?php 
                echo $this->Html->link(__('Contact'),
                    array(
                        'controller' => 'pages',
                        'action' => 'contact',
                        'admin' => false
                    )
                );
                ?>
                </li>
                <li>
                <?php 
                echo $this->Html->link(__('Blog'), 'http://blog.onneblue.com');
                ?>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                <?php 
                echo $this->Html->link(__('Login'), 
                    array(
                        'controller' => 'users',
                        'action' => 'login',
                        'admin' => true
                    )
                );
                ?>
                </li>
                <li class="divider-vertical"></li>
                <?php echo $this->element('language'); ?>
            </ul>
        </div>
    </div>
</nav>