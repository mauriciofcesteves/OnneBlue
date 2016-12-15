<?php
echo $this->Html->link(__('Import'), '#',
    array(
        'class' => 'btn btn-primary',
        'data-toggle' => 'modal',
        'data-target' => '#open-import-modal',
        'escape' => false,
    )
);
?>
</div>

<!-- Modal -->
<div class="modal fade" id="open-import-modal" tabindex="-1" role="dialog" aria-labelledby="import-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo __('Close'); ?></span></button>
                <h4 class="modal-title" id="import-modal'"><?php echo __('Import'); ?></h4>
            </div>
            <div class="modal-body">
                <h5><?php echo __('Step 1'); ?></h5>
                <?php
                echo $this->Form->create('UploadForm', 
                    array('enctype' => 'multipart/form-data')
                );
                echo $this->Harvest->link(__('Download Spreadsheet Model'),
                    array('action' => 'download_spreadsheet'),
                    array(
                        'class' => 'btn btn-primary',
                        'escape' => false
                    )
                );
                ?>
                <hr>
                <h5><?php echo __('Step 2'); ?></h5>
                <?php
                echo $this->Form->file('UploadForm.data', 
                    array(
                        'class' => 'filestyle',
                        'id' => 'imgInp',
                    )
                );
                ?>
                <hr>
                <h5><?php echo __('Step 3'); ?></h5>
                <?php
                echo $this->Form->submit(__('Import'), 
                    array(
                        'id' => 'save_file_upload',
                        'class' => 'btn btn-primary no-margin',
                        'div' => false,
                    )
                );
                echo $this->Form->end();
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs no-margin" data-dismiss="modal"><?php echo __('Close'); ?></button>
            </div>
        </div>
    </div>