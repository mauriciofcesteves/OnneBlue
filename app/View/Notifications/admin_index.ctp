<div class="row show-grid">
	<div class="col-lg-12">
		<h2 class="text-center small-vertical-space"><?php echo __('Notifications'); ?></h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<?php
		$month = '';
		$total = count($notifications);
		foreach ($notifications as $notificationKey => $notificationValue) {
			if (empty($month) === true || $month !== $notificationValue['Notification']['created_month']) {
				$month = $notificationValue['Notification']['created_month'];
				?>
				<h3 class="small-vertical-space"><?php echo __($notificationValue['Notification']['created_month']); ?></h3>
			<?php }

			switch ($notificationValue['Notification']['type']) {
				case 'Input expiration':
					echo $this->element('notifications/input-expiration-all', array('data' => $notificationValue));
					break;
			} 

			if ($total > $notificationKey + 1) { ?>
				<hr>
		<?php
			}
		} 
		?>
	</div>
</div>