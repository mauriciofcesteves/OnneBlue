<?php

//se o parametro n foi passado, entao atribui false
if (!isset($show_import_button)) {
    $show_import_button = false;
}

// Check if the title was passed
if (isset($title) === false || empty($title) === true) {
    // Defines the title as a controller name
    $title = Inflector::humanize($this->params['controller']);
    switch ($title) {
        case 'Units Measures':
            $title = 'Units of Measure';
            break;
    }
}
// Check if the buttons was passed
if (isset($buttons) === false || empty($buttons) === true) {
    $button[] = array(
        'name' => __('Add'),
        'icon' => 'fa-plus',
        'action' => 'add'
    );
} else {
    foreach ($buttons as $buttonKey => $buttonValue) {
        if ($buttonValue === 'list') {
            $button[] = array(
                'name' => __('List'),
                'icon' => 'fa-list',
                'action' => 'index'
            );
        } else {
            $button[] = array(
                'name' => $buttonValue['name'],
                'icon' => 'fa-plus',
                'action' => $buttonValue['action']
            );
        }
    }
}
// Check the action to define the icon
switch ($this->params['action']) {
    case 'admin_index':
        $icon = 'fa-list';
        break;
    case 'admin_edit':
        $icon = 'fa-pencil';
        break;
    case 'admin_add':
        $icon = 'fa-plus';
        break;
}
?>
<div class="row show-grid">
    <div class="col-lg-12">
        <h2 class="text-center small-vertical-space"><?php echo __($title); ?></h2>
        <div class="row">
            <div class="col-sm-7">
                <div class="btn-group">
                    <?php 
                    foreach ($button as $key => $value) {
                        echo $this->Html->link(__('%s %s%s', '<i class="fa '.$value['icon'].'"></i><span class="hidden-xs">', $value['name'], '</span>'),
                            array(
                                'action' => $value['action'],
                            ),
                            array(
                                'class' => 'btn btn-primary',
                                'escape' => false
                            )
                        );
                    }

                    if ($show_import_button) {
                        echo $this->element('import-button');
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>