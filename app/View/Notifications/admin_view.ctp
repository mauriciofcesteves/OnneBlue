<div class="row show-grid">
	<div class="col-lg-12">
		<h2 class="text-center small-vertical-space"><?php echo __('Notification'); ?></h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php
		switch ($notification['Notification']['type']) {
			case 'Input expiration':
				echo $this->element('notifications/input-expiration-all', array('data' => $notification));
				break;
		}
		?>
	</div>
</div>