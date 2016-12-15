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

?>
<!DOCTYPE html>
<html lang="<?php echo $siLanguage['iso-639-2']; ?>">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
		<meta name="viewport" content="width=device-width">
	<?php
		$lang = $this->Session->read('onneblue_language');
		echo $this->Html->meta('icon');
		echo $this->Html->meta(array('name' => 'author', 'content' => 'Harvest Sistemas'));
		echo $this->Html->meta(array('name' => 'description', 'content' => 'OnneBlue error.'));
		echo $this->Html->meta(array('name' => 'keywords', 'content' => 'error,harvest, erp, management system, onneblue, admin'));
		echo $this->fetch('meta');
		// CSS
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('erp');
		echo $this->Html->css('sticky-footer');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('hs.bootstrap');
		echo $this->Html->css('font-awesome.min');
		echo $this->fetch('css');
		// JS
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="wrap-container" class="error">
		<div class="container" id="content">
			<div class="row">
			    <div class="col-lg-12 text-center">
			        <i class="fa fa-frown-o fa-5x"></i>
			    </div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1><strong>OnneBlue</strong></h1>
					<?php 
					echo $this->Session->flash(); 
					echo $this->Session->flash('auth'); 
					echo $this->fetch('content'); 
					?>
				</div>
			</div>
		</div>
		<div class="push"></div>
	</div>
</body>
</html>
