<?php foreach ($plans as $planKey => $planValue) { ?>
<div class="col-md-4 col-sm-6">
    <div class="pricing-table">
        <div class="princing-table">
            <div class="head text-center">
                <h3><?php echo __('OnneBlue'); ?><br><small><?php echo $planValue['Plan']['name']; ?></small></h3>
                <?php
                if ($planValue['Plan']['price_float'] === '0.00') { ?>
                    <span class="price"><?php echo __('Free'); ?></span><br>
                <?php } else {
                    $total = ($planValue['Plan']['price_float']*12);
                    $totalDiscount = round($total - $total*$planValue['PlansPeriod'][2]['discount'], 2);
                    ?>
                    <span class="price"><?php echo $planValue['Plan']['price']; ?></span><br>
                    <span class="unit"><?php echo __('per month'); ?></span><br>
                    <span class="year"><?php echo __('or %s per year', CakeNumber::currency($totalDiscount, 'BRL')); ?></span>
                <?php } ?>
                <span class="start-now">
                <?php
                if (isset($register) === true && $register === true) {
                    echo $this->Html->link(__('Start Now'),
                        array(
                            'controller' => 'users',
                            'action' => 'register',
                            'admin' => false
                        ),
                        array(
                            'class' => 'btn btn-success'
                        )
                    );
                } else {
                    echo $this->Html->link(__('Choose this plan'),
                        array(
                            'controller' => 'plans',
                            'action' => 'pay',
                            $planValue['Plan']['id']
                        ),
                        array(
                            'class' => 'btn btn-success btn-plan',
                        )
                    );
                }
                ?>
                </span>
            </div>
            <div class="features">
                <b><?php echo __('The OnneBlue Starter includes:'); ?></b><br><br>
                <ul>
                    <?php foreach ($planValue['PlansFeature'] as $planFeatureKey => $planFeatureValue) { ?>
                    <li><?php echo __($planFeatureValue['description']); ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php } ?>