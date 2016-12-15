<div class="bs-callout bs-callout-danger remaining-records">
    <h4><?php echo __('Remaining records'); ?></h4>
    <div class="progress">
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $countRecords; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $countRecords; ?>%">
        </div>
        <span class="text">
            <?php
            $total = (100 - $countRecords);
            $left = ' '.__('remaining records');
            if ($total === 1) {
                $left = ' '.__('remaining record');
            }
            echo $total.$left;
            ?>
        </span>
    </div>
</div>