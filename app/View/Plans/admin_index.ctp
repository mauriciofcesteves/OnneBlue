<?php
echo $this->Html->css('prices', array('block' => 'css'));
echo $this->Html->css('bootstrap-slider', array('block' => 'css'));
echo $this->Html->script('bootstrap-slider', array('inline' => false));
?>
<div class="container">
    <div class="row show-grid">
        <div class="col-lg-12 text-center">
            <h2 class="mid-vertical-space"><?php echo __('Plans'); ?><br><small><?php echo __('To hire a plane, just choose and click on monthly or annual'); ?></small></h2>
        </div>
    </div>

    <div class="row">
        <?php
        echo $this->Form->create('Plan');
        echo $this->element('plans', array('plans' => $plans));
        echo $this->Form->end();
        ?>
    </div>

    <div class="row show-grid">
        <div class="col-lg-12 text-center">
            <h2 class="mid-vertical-space"><?php echo __('Additional Users'); ?></h2>
        </div>
    </div>

    <div class="row pricing">
        <?php echo $this->Form->create('Plan'); ?>
        <div class="col-md-5 col-sm-6 center-block">
            <div class="pricing-table auto">
                <div class="princing-table">
                    <div class="head text-center">
                        <h3><?php echo __('User'); ?><br><small><?php echo __('Each'); ?></small></h3>
                        <span class="price">R$9</span><br>
                        <span class="start-now">
                            <?php
                            if ($userData['Business']['plan_id'] === '1') {
                                echo __('You can not buy additional users to the free plan');
                            } else {
                                echo $this->Form->button(__('Purchase'),
                                    array(
                                        'class' => 'btn btn-success btn-plan',
                                        'escape' => false,
                                        'name' => 'User',
                                    )
                                );
                            }
                            ?>
                        </span>
                    </div>
                    <?php if ($userData['Business']['plan_id'] !== '1') { ?>
                    <div class="features text-center">
                        <?php
                        echo $this->Form->input('User.amount',
                            array(
                                'id' => 'ex1',
                                'data-slider-id' => 'ex1Slider',
                                'data-slider-min' => '1',
                                'data-slider-max' => '20',
                                'data-slider-step' => '1',
                                'data-slider-value' => '5',
                                'label' => false
                            )
                        );
                        ?>
                        <script type="text/javascript">
                        var slider = new Slider('#ex1', {
                            tooltip: 'always',
                            formatter: function(value) {
                                return value;
                            }
                        });
                        </script>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
