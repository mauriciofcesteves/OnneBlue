<?php
$read = '';
if ($data['Notification']['is_read'] === '1') {
	$read = 'read';
}
?>
<li class="<?php echo $read; ?>">
<?php
$text = __('<b>Shelf life</b><br>The product %s is near the expiration date', $data['Product']['name']);
echo $this->Html->link(
	$text, 
	array(
		'controller' => 'notifications',
		'action'	 => 'view',
		'admin'	 	 => true,
		'plugin' 	 => false,
		$data['Notification']['id']
	),
	array('escape' => false)
);
?>
</li>