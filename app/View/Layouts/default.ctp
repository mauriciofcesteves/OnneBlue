<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$siteName = 'siMarta App:';
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteName ?> 
		<?php echo $title_for_layout; ?>
	</title>
		<meta name="viewport" content="width=device-width">
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		// CSS
		echo $this->Html->css('normalize.min');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('foundation.min');
		echo $this->Html->css('icons/foundation-icons');
		echo $this->Html->css('simarta');
		echo $this->Html->css('select2/select2.min');
		echo $this->Html->css('sticky-footer.min');
		echo $this->fetch('css');
		// JS
		echo $this->Html->script('vendor/custom.modernizr');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery-ui.min.js');
		echo $this->Html->script('jquery.mask');
		echo $this->Html->script('select2/select2');
		echo $this->Html->script('si.autofocus.min');
		echo $this->fetch('script');
	?>
	<script>
    $(document).ready(function() {
    	// Select2
		$("select").select2({
			width : '100%'
		}); 
    });
    </script>
</head>
<body>

	<div class="wrapper">
		<div class="wrap-top-bar">
			<div class="row">
				<div class="large-12 columns">
					<nav class="top-bar" data-topbar>
						<ul class="title-area">
							<li class="name">
								<h1>
									<?php 
									echo $this->Html->link('<i class="fi-home size-24"></i>', 
										array(
											'controller' => 'pages',
											'action' => 'index',
											'admin' => false
										),
										array(
											'escape' => false,
											'title' => __('Home')
										)
									);
									?>
								</h1>
							</li>
					    	<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<section id="container">
			<div class="row">
				<div class="large-12 columns">
					<?php 
					echo $this->Session->flash(); 
					echo $this->Session->flash('auth', array('element' => 'flash_alert'));
					echo $this->fetch('content'); 
					echo $this->element('sql_dump');
					?>
				</div>
			</div>
		</section>

		<div class="push"></div>
	</div>

	<?php 
	echo $this->element('footer');
	echo $this->Html->script('foundation.min'); 
	?>
	<script>
		$(document).foundation();
	</script>
</body>
</html>
