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
    if ($this->Harvest->isBeta() === true) {
        echo '<meta name="robots" content="noindex,noarchive,nosnippet,nofollow">';
    }
    $lang = $this->Session->read('onneblue_language');
    echo $this->Html->meta('icon');
    echo $this->Html->meta(array('name' => 'author', 'content' => 'Harvest Sistemas'));
    echo $this->Html->meta(array('name' => 'description', 'content' => $seo_description));
    echo $this->Html->meta(array('name' => 'keywords', 'content' => $seo_keywords));
    echo $this->fetch('meta');
    // CSS
    echo $this->Html->css('bootstrap.min');
    // echo $this->Html->css('erp');
    echo $this->Html->css('select2/select2.min');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('sequencejs-theme.modern-slide-in');
    // echo $this->Html->css('hs.bootstrap');
    echo $this->Html->css('onneblue');
    echo $this->fetch('css');
    // JS
    echo $this->Html->script('lang/'.$siLanguage['iso-639-2']);
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('select2/select2.min');
    echo $this->Html->script('si.autofocus.min');
    echo $this->Html->script('jquery.sequence-min');
    echo $this->Html->script('sequencejs-options.modern-slide-in');
    echo $this->Html->script('masonry.pkgd.min');
    if (Configure::read('MyApp.mode') === 'beta') {
        echo $this->Html->script('jquery.countdown.min');
    }
        echo $this->fetch('script');
    ?>
    <script>
    $(document).ready(function() {
        // Select2
        $("select").select2({
            width : 'element'
        }); 
    });
    </script>
</head>
<body class="margin-top">
    <script>
        // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        // ga('create', 'UA-56926602-1', 'auto');
        // ga('send', 'pageview');
    </script>

    <?php echo $this->element('menu'); ?>

    <?php
    echo $this->Session->flash(); 
    echo $this->Session->flash('auth');
    echo $this->fetch('content');
    echo $this->element('sql_dump');
    ?>

    <?php echo $this->element('footer'); ?>

</body>
</html>