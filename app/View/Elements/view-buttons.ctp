<?php
if (isset($entity) === false && empty($entity) === true) {
    $entity = __('the system register');
}
?>
<div class="btn-group btn-group-justified">
    <?php 
    echo $this->Html->link(__('%s List%s', '<i class="fa fa-list"></i><span class="hidden-xs">', '</span>'), 
        array(
            'action' => 'index'
        ), 
        array(
            'class' => 'btn btn-primary',
            'escape' => false
        )
    ); 
    echo $this->Html->link(__('%s Add%s', '<i class="fa fa-plus"></i><span class="hidden-xs">', '</span>'), 
        array(
            'action' => 'add'
        ), 
        array(
            'class' => 'btn btn-primary',
            'escape' => false
        )
    ); 
    echo $this->Html->link(__('%s Edit%s', '<i class="fa fa-pencil"></i><span class="hidden-xs">', '</span>'), 
        array(
            'action' => 'edit', 
            $id
        ), 
        array(
            'class' => 'btn btn-primary',
            'escape' => false
        )
    );  
    echo $this->Form->postLink(__('%s Delete%s', '<i class="fa fa-trash-o"></i><span class="hidden-xs">', '</span>'), 
        array(
            'action' => 'delete', 
            $id
        ),
        array(
            'class' => 'btn btn-danger',
            'escape' => false, 
        ), 
        __('Are you sure you want to delete %s?', $entity)
    ); 
    ?>
</div>