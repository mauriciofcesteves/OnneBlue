<?php
$read = '';
if ($data['Notification']['is_read'] === '1') {
	$read = 'read';
}
$productLink = $this->Html->link($data['Product']['name'], '#');
?>
<div class="<?php echo $read; ?>">
<h4><?php echo __('Shelf life'); ?> <small> - <?php echo $data['Notification']['created']; ?></small></h4>
<p><?php echo __('The product <b>%s</b> is near the expiration date. The product will pass the expiration date on <span class="light-red">%s</span>.', $productLink, $data['InputsOutput']['expiration_date']); ?></p>
</div>