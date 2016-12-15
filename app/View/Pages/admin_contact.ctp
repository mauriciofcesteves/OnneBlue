<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center"><?php echo __('%sContact', '<span class="fa-stack fa-lg"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i></span>'); ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-7 col-sm-9 center-block">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    echo $this->Form->create('Contact', array('url' => array('controller' => 'pages'), 'novalidate'));
                        echo $this->Form->inputs(array(
                            'legend' => false,
                            'subject' => array(
                                'label' => __('Subject'),
                                'class' => 'form-control',
                                'div' => 'form-group',
                            ),
                            'message' => array(
                                'label' => __('Message'),
                                'class' => 'form-control',
                                'type' => 'textarea',
                                'div' => 'form-group',
                            )
                        ));
                        ?>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <?php 
                                echo $this->Form->submit(__('Send'), 
                                    array(
                                        'class' => 'btn btn-primary'
                                    )
                                );
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <span class="required-text"><i class="fa fa-asterisk"></i> <?php echo __('indicates a required field'); ?></span>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>