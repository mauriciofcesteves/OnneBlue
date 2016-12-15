<?php
$noBreadcrumb
    = array(
        'inputs_outputs'
    );
?>
<ol class="breadcrumb">
    <li>
    <?php
    echo $this->Html->link('OnneBlue',
        array(
            'controller' => 'dashboard',
            'action' => 'index',
            'admin' => true,
            'plugin' => false
        )
    );
    ?>
    </li>
    <?php
    if (isset($this->plugin) === true && empty($this->plugin) === false) { ?>
    <li>
        <?php
        echo $this->Html->link(__(Inflector::humanize($this->params['plugin'])),
            array(
                'controller' => 'dashboard',
                'action' => 'index',
                'admin' => true,
                'plugin' => $this->params['plugin']
            )
        );
        ?>
    </li>
    <?php
    }

    if (isset($this->params['controller']) === true && $this->params['controller'] !== 'dashboard' && in_array($this->params['controller'], $noBreadcrumb) === false) { ?>
    <li>
        <?php
        if (isset($this->params['action']) === true && $this->params['action'] === 'admin_index') {
            echo __(Inflector::humanize($this->params['controller']));
        } else {
            echo $this->Html->link(__(Inflector::humanize($this->params['controller'])),
                array(
                    'controller' => $this->params['controller'],
                    'action' => 'index',
                    'admin' => true,
                    'plugin' => $this->params['plugin']
                )
            );
        }
        ?>
    </li>
    <?php
    }

    if (isset($this->params['action']) === true && $this->params['action'] !== 'admin_index') { ?>
    <li>
        <?php echo __(Inflector::humanize(str_replace('admin_', '', $this->params['action']))); ?>
    </li>
    <?php } ?>
</ol>