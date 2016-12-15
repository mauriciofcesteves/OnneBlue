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
<html lang="<?php echo $siLanguage['lang']; ?>">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
		<meta name="viewport" content="width=device-width, user-scalable=no">
	<?php
		$lang = $this->Session->read('onneblue_language');
		echo '<meta name="robots" content="noindex,noarchive,nosnippet,nofollow">';
		echo $this->Html->meta('icon');
		echo $this->Html->meta(array('name' => 'author', 'content' => 'Harvest Sistemas'));
		echo $this->Html->meta(array('name' => 'description', 'content' => $seo_description));
		echo $this->Html->meta(array('name' => 'keywords', 'content' => $seo_keywords));
		echo $this->fetch('meta');
		// CSS
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->css('select2/select2.min');
		echo $this->Html->css('select2-bootstrap');
		echo $this->Html->css('bootstrap-switch.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('nprogress');
		echo $this->Html->css('jquery.datetimepicker');
		echo $this->Html->css('bootstrap-tour.min');
		echo $this->Html->css('onneblue');
		echo $this->fetch('css');
		// JS
		echo $this->Html->script('lang/'.$siLanguage['iso-639-2']);
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery-ui.min');
		echo $this->Html->script('modernizr');
		echo $this->Html->script('jquery.mask');
		// echo $this->Html->script('angular.min.js');
		echo $this->Html->script('jquery.price-format');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('select2/select2');
		echo $this->Html->script('jquery.mCustomScrollbar.concat.min');
		if ($siLanguage['iso-639-2'] === 'pt') {
			echo $this->Html->script('select2/select2_locale_pt-BR');
		}
		echo $this->Html->script('si.autofocus.min');
		echo $this->Html->script('bootstrap-switch.min');
		echo $this->Html->script('jquery.multilevelpushmenu.min');
		echo $this->Html->script('jquery.cookie');
		echo $this->Html->script('masonry.pkgd.min');
		echo $this->Html->script('si.app');
		echo $this->Html->script('nprogress');
		echo $this->Html->script('jquery.datetimepicker');
		echo $this->Html->script('bootstrap-tour.min');
		echo $this->Html->script('bootstrap-filestyle');
		echo $this->fetch('script');
	?>
	<script>
    $(document).ready(function() {
    	$("form .required label, .custom-required").after(' <i class="fa fa-asterisk"></i>');
    	// Select2
		$('.has-popover').popover({
			trigger : 'focus click'
		});
		$(".has-select2").select2({
			width : '100%',
		});
		$("[class='bootstrap-switch']").bootstrapSwitch();
		$("[class='bootstrap-switch']").on('switchChange.bootstrapSwitch', function(event, state) {
			if (state) { $(this).val(1); } else { $(this).val(0); }
		});
    });
    </script>
</head>
<body class="margin-top">

	<?php echo $this->element('admin-menu'); ?>
    <div id="wrapper" class="no-sidebar">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					<?php 
					echo $this->Session->flash(); 
					echo $this->Session->flash('auth'); 
					echo $this->fetch('content');
					echo $this->element('sql_dump');
					?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->element('footer'); ?>
    </div>

</body>
</html>
