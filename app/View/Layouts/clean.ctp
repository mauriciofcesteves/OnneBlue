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
        echo '<meta name="robots" content="noindex,noarchive,nosnippet,nofollow">';
        echo $this->Html->meta('icon');
        echo $this->Html->meta(array('name' => 'author', 'content' => 'Harvest Sistemas'));
        echo $this->Html->meta(array('name' => 'description', 'content' => $seo_description));
        echo $this->Html->meta(array('name' => 'keywords', 'content' => $seo_keywords));
        echo $this->fetch('meta');
        // CSS
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('onneblue');
        echo $this->fetch('css');
        // JS
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery-ui.min');
        echo $this->Html->script('modernizr');
        echo $this->Html->script('bootstrap.min');
        echo $this->fetch('script');
    ?>
    </script>
</head>
<body class="margin-top">

    <?php echo $this->element('clean-menu'); ?>
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
