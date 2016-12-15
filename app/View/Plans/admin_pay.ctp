<div class="container">
    <div class="row show-grid">
        <?php echo $this->Form->create('Pay', array('novalidate')); ?>
        <div class="col-lg-12 text-center">
            <h2 class="mid-vertical-space"><?php echo __('Payment Plan'); ?><br><small><?php echo __('OnneBlue %s', $plan['Plan']['name']); ?></small></h2>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="small-vertical-space"><?php echo __('Select a period:'); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div data-toggle="buttons">
                    <?php
                    foreach ($plan['PlansPeriod'] as $planKey => $planValue) {
                        echo $this->Harvest->planPeriod($plan['Plan']['price_float'], $planValue);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mid-vertical-space"><?php echo __('Select a payment method:'); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 center-block">
                <div data-toggle="buttons">
                    <label class="btn btn-pay-method">
                        <input type="radio" name="payment-method" value="pagseguro" autocomplete="off">
                        <span class="title"><?php echo __('PagSeguro'); ?></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="mid-vertical-space"><small><?php echo __('No additional fee will be charged'); ?></small></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php 
                echo $this->Form->button(__('Continue'),
                    array(
                        'type' => 'submit',
                        'class' => 'btn btn-success btn-lg',
                        'div' => false
                    )
                );
                ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>

</div>