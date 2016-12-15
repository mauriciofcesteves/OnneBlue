<?php
/**
 *
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
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$this->layout = 'error';
?>
<h3><?php echo __('<strong>500.</strong> Internal Server Error'); ?></h3>
<p><?php echo	__('<strong>Error:</strong> %s', $name); ?></p>
<?php
echo $this->Html->link(__('%s Back%s', '<i class="fa fa-arrow-left"></i><span class="hidden-xs">', '</span>'), 
    $url,
    array(
        'class' => 'btn btn-primary',
        'escape' => false
    )
);
?>
