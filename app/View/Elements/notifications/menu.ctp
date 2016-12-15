<?php
$unread = '';
if (isset($hasNotifications) === true && $hasNotifications === '1') {
	$unread = 'unread';
}
?>
<li class="dropdown notification <?php echo $unread; ?>">
	<?php
	echo $this->Html->link(__('%s', '<span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-bell fa-stack-1x fa-inverse"></i></span></i>'), '#',
		array(
			'class' => 'dropdown-toggle icon',
			'data-toggle' => 'dropdown',
			'escape' => false
		)
	);
	?>
	<ul class="dropdown-menu">
		<?php
		if (empty($menuNotifications) === false) {
			foreach ($menuNotifications as $notificationKey => $notificationValue) {
				switch ($notificationValue['Notification']['type']) {
					case 'Input expiration':
						echo $this->element('notifications/input-expiration', array('data' => $notificationValue));
						break;
				}
				echo '<li class="divider"></li>';
			}
		}
		?>
		<li class="text-center">
			<?php
			echo $this->Html->link(
				__('See all notifications'),
				array(
					'controller' => 'notifications',
					'action'	 => 'index',
					'admin'		 => true,
					'plugin'	 => false
				)
			);
			?>
		</li>
	</ul>
</li>