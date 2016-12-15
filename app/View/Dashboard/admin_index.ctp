<?php echo $this->Html->css('shortcut', array('inline' => false)); ?>
<h2 class="text-center small-vertical-space"><?php echo __('Which system would you like to use?'); ?></h2>
<div class="wrap-shortcut" id="step4">
	<div class="masonry js-masonry" data-masonry-options='{ "columnWidth" : 150, "itemSelector": ".shortcut", "isFitWidth" : true, "gutter": 30 }'>
		<?php
		echo $this->Harvest->link(__('%sIs%s Inventory System', '<i class="ob ob-is">', '</i>'),
			array(
				'controller' => 'dashboard',
				'action' => 'index',
				'admin' => true,
				'plugin' => 'inventory_system'
			),
			array(
				'class' => 'shortcut',
				'escape' => false
			)
		);
		
		echo $this->Html->link(__('%sFs%s Financial System', '<i class="ob ob-is">', '</i>'), 
			array(
				'controller' => 'dashboard',
				'action' => 'index',
				'admin' => true,
				'plugin' => 'financial_system'
			),
			array(
				'class' => 'shortcut',
				'escape' => false
			)
		);
		
		?>
	</div>
</div>
<?php echo $this->Harvest->tour('general.first-access', $userData); ?>