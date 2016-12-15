<nav class="navbar navbar-top navbar-fixed-top navbar-white clean no-collapse has-center-logo" role="navigation">
    <div class="container">
        <div id="navbar">
            <div id="onneblue-icon-fixed">
                <?php
                echo $this->Html->link('',
                    array(
                        'controller' => 'pages',
                        'admin' => false,
                        'plugin' => false
                    ),
                    array(
                        'escape' => false
                    )
                );
                ?>
            </div>

                <ul class="nav navbar-nav navbar-right">
                    <li class="divider-vertical"></li>
                    <?php echo $this->element('language'); ?>
                </ul>
        </div>
    </div>
</nav>