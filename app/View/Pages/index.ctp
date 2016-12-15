<?php echo $this->Html->css('vertical-timeline', array('inline' => false)); ?>
<div class="jumbotron" id="presentation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><span class="big">OnneBlue</span></h2>
                <h2><?php echo __('Ensure the future of your business'); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="lg-12 center-block text-center register-button">
                <?php
                echo $this->Html->link(__('I want to!'),
                    array(
                        'controller' => 'users',
                        'action' => 'register',
                        'admin' => false
                    ),
                    array(
                        'class' => 'btn btn-transparent btn-lg no-border',
                        'type' => 'submit',
                        'div' => 'form-group',
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

<!--         <div class="row">
            <div class="col-sm-9 col-md-6 col-lg-5 center-block text-center">
                <?php
                $videoImage = $this->Html->image('video.jpg',
                    array(
                        'class' => 'img-responsive',
                        'alt' => __('OnneBlue Video')
                    )
                );
                echo $this->Html->link($videoImage, '#',
                    array(
                        'escape' => false,
                        'data-toggle' => 'modal',
                        'data-target' => '#onneblue-video',
                        'class' => 'onneblue-video-trigger'
                    )
                );
                ?>
            </div>
        </div>
        <div class="modal fade" id="onneblue-video" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div id="wistia_prz61ud3ef" class="embed-responsive-item">&nbsp;</div>
                        <script charset="ISO-8859-1" src="http://fast.wistia.com/static/concat/E-v1.js"></script>
                        <script>
                        wistiaEmbed = Wistia.embed("prz61ud3ef");

                        $('#onneblue-video').on('show.bs.modal', function (event) {
                            wistiaEmbed.play();
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div> -->

    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="uppercase"><?php echo __('Focused on the solution.'); ?><br><small><?php echo __('The OnneBlue has resources for their needs.'); ?></small></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section id="cd-timeline" class="cd-container">
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                        <i class="fa fa-smile-o fa-3x"></i>
                    </div>

                    <div class="cd-timeline-content">
                        <h2><?php echo __('Simple and friendly'); ?></h2>
                        <p><?php echo __('Intuitive system. Use with ease.'); ?></p>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                        <i class="fa fa-tablet fa-3x"></i>
                    </div>

                    <div class="cd-timeline-content">
                        <h2><?php echo __('Optimized experience'); ?></h2>
                        <p><?php echo __('Adaptive Design. Ready for access by computer or mobile devices.'); ?></p>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                        <i class="fa fa-rocket"></i>
                    </div>

                    <div class="cd-timeline-content">
                        <h2><?php echo __('Technology and Navigation'); ?></h2>
                        <p><?php echo __('Developed with the latest technology. Fast and secure shipping.'); ?></p>
                    </div>
                </div>
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                        <i class="fa fa-arrow-up fa-3x"></i>
                    </div>

                    <div class="cd-timeline-content">
                        <h2><?php echo __('Constant updates'); ?></h2>
                        <p><?php echo __('OnneBlue is constantly developing. Always striving to meet the needs of their customers.'); ?></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php echo $this->Html->script('vertical-timeline'); ?>