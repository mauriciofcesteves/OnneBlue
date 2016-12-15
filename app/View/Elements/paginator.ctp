<div class="row">
    <div class="col-lg-12">
        <?php if(isset($emptySearch)) { ?>
            <div class="alert alert-info text-center">
            	<i class="fa fa-exclamation-triangle fa-5x"></i>
                <p><?php echo __('No results found'); ?></p>
            </div>
        <?php } else { ?>
        	<div data-alert class="alert alert-info">
        	<?php
        	echo $this->Paginator->counter(
        		array(
        			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        		)
        	);
        	?>
        	</div>
        <?php } ?>

        <?php if(isset($pageCount) && $pageCount > 1) { ?>
            <div class="text-center">
                <ul class="pagination">
                    <?php
                        echo $this->Paginator->prev(__('<span class="hidden-xs">prev</span><span class="visible-xs"><i class="fa fa-arrow-left"></i></span>'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a', 'escape' => false));
                        echo $this->Paginator->numbers(array('separator' => '', 'ellipsis' => false, 'currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                        echo $this->Paginator->next(__('<span class="hidden-xs">next</span><span class="visible-xs"><i class="fa fa-arrow-right"></i></span>'), array('tag' => 'li', 'escape' => false), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a', 'escape' => false));
                    ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>