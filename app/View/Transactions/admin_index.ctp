<div class="row show-grid">
    <div class="col-lg-12">
        <h2><?php echo __('Transactions'); ?></h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th><?php echo $this->Paginator->sort('Plan.name'); ?></th>
                    <th class="hidden-xs"><?php echo $this->Paginator->sort('Period'); ?></th>
                    <th class="hidden-xs"><?php echo $this->Paginator->sort('Price'); ?></th>
                    <th class="hidden-xs"><?php echo $this->Paginator->sort('Status'); ?></th>
                    <?php echo $this->element('admin-actions-title'); ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($transactions as $transaction) { ?>
                <tr>
                    <td><?php echo h($transaction['Transaction']['created']); ?>&nbsp;</td>
                    <td><?php echo h($transaction['Plan']['name']); ?>&nbsp;</td>
                    <td class="hidden-xs"><?php echo __($transaction['Transaction']['period']); ?>&nbsp;</td>
                    <td class="hidden-xs"><?php echo $transaction['Transaction']['price']; ?>&nbsp;</td>
                    <td class="hidden-xs"><?php echo $this->Harvest->PagSeguroStatus($transaction['Transaction']['status']); ?>&nbsp;</td>
                    <?php echo $this->element('admin-actions', array('id' => $transaction['Transaction']['id'], 'entity' => $transaction['Transaction']['id'])); ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $this->element('paginator'); ?>