<?php
if ($this->params['action'] === 'admin_add') {
    $text = __('Are you sure you want to cancel adding');
} else {
    $text = __('Are you sure you want to cancel editing');
}
if (isset($action) === false || empty($action) === true) {
    $action = 'index';
}
if (isset($entity) === false || empty($entity) === true) {
    $entity = __('the register');
}
?>
<div class="row">
    <div class="col-sm-6">
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
                'action' => $action,
            ), 
            array(
                'class' => 'btn btn-danger cancel',
                'escape' => false
            ),
            __('%s %s?', $text, $entity)
        );
        ?>
    </div>
    <div class="col-sm-6">
        <span class="required-text"><i class="fa fa-asterisk"></i> <?php echo __('indicates a required field'); ?></span>
    </div>
</div>