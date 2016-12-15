<?php echo $this->Html->css('plans', array('block' => 'css')); ?>
<div class="row show-grid">
    <div class="col-lg-12">
        <h2><?php echo __('%sSubscriptions Plans', '<span class="fa-stack fa-lg"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span>'); ?></h2>
    </div>
</div>

<div class="row pricing">
    <div class="col-md-4 col-sm-6">
        <div class="ccr-pricing-table bronze">
            <section class="ccr-pricing-header">
                <p class="ccr-price-title"><?php echo __('Bronze'); ?></p>
                <p class="ccr-price-value"> <sup>R$</sup>21<span>/ <?php echo __('mo.'); ?></span> </p>
                <p class="ccr-price-quality"><em><?php echo __('Perfect for resellers'); ?></em></p>
            </section>
            <section class="ccr-pricing-ul">
                <ul>
                    <li><i class="fa fa-cubes"></i><?php echo __('Inventory System'); ?> <span class="basic"><?php echo __('BASIC'); ?></span> <i class="fa fa-check"></i>
                        <ul>
                            <li><?php echo __('Products'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Suppliers'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Customers'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Categories'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Units of Measure'); ?> <i class="fa fa-times"></i></li>
                            <li><?php echo __('Inbounds'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Outbonds'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Perform Inventory'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Inventory Report'); ?> <i class="fa fa-times"></i></li>
                            <li><?php echo __('Best Sellers Report'); ?> <i class="fa fa-times"></i></li>
                        </ul>
                    </li>
                    <li><i class="fa fa-user"></i><?php echo __('%s User', '1'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-users"></i><?php echo __('Additional Users'); ?> <i class="fa fa-times"></i></li>
                    <li><i class="fa fa-database"></i><?php echo __('%s Space', '20MB'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-mobile"></i><?php echo __('Mobile'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-lock"></i><?php echo __('Access Control'); ?> <i class="fa fa-times"></i></li>
                </ul>
            </section>
            <section class="ccr-pricing-footer">
                <button class="ccr-price-host"><?php echo __('Pay Now'); ?></button>
            </section>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="ccr-pricing-table silver">
            <section class="ccr-pricing-header">
                <p class="ccr-price-title"><?php echo __('Silver'); ?></p>
                <p class="ccr-price-value"> <sup>R$</sup>39<span>/ <?php echo __('mo.'); ?></span> </p>
                <p class="ccr-price-quality"><em><?php echo __('Perfect for small business'); ?></em></p>
            </section>
            <section class="ccr-pricing-ul">
                <ul>
                    <li><i class="fa fa-cubes"></i><?php echo __('Inventory System'); ?> <span class="advanced"><?php echo __('ADVANCED'); ?></span> <i class="fa fa-check"></i>
                        <ul>
                            <li><?php echo __('Products'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Suppliers'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Customers'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Categories'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Units of Measure'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Inbounds'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Outbonds'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Perform Inventory'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Inventory Report'); ?> <i class="fa fa-check"></i></li>
                            <li><?php echo __('Best Sellers Report'); ?> <i class="fa fa-check"></i></li>
                        </ul>
                    </li>
                    <li><i class="fa fa-user"></i><?php echo __('%s User', '1'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-users"></i><?php echo __('Additional Users'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-database"></i><?php echo __('%s Space', '40MB'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-mobile"></i><?php echo __('Mobile'); ?> <i class="fa fa-check"></i></li>
                    <li><i class="fa fa-lock"></i><?php echo __('Access Control'); ?> <i class="fa fa-check"></i></li>
                </ul>
            </section>
            <section class="ccr-pricing-footer">
                <button class="ccr-price-host"><?php echo __('Pay Now'); ?></button>
            </section>
        </div>
    </div>
</div>