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
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout; ?></title>
</head>
<body>

    <div style="background-color:#F1F2F6;">
        <br>
        <div style="margin:2%">
            <div style="direction:ltr;font-family:'Open sans','Arial',sans-serif;color:#444;background-color:white;border-radius:.5em;max-width:600px;margin:auto;">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <div style="width:120px;margin:auto;margin-top:40px;">
                                    <?php echo $this->Html->image('http://onneblue.com/img/email/onneblue.png', array('alt' => 'OnneBlue')); ?>
                                </div>
                                <?php if (isset($name) === true && empty($name) === false) { ?>
                                <div style="padding:10px 20px;">
                                    <p>
                                        <span style="font-weight:bold;font-size:small;line-height:1.4em"><?php echo __('Hello, %s', $name); ?></span>
                                    </p>
                                </div>
                                <?php } else { ?>
                                <div style="padding:10px 20px;">
                                    <p>
                                        <span style="font-weight:bold;font-size:small;line-height:1.4em"><?php echo __('Hello'); ?></span>
                                    </p>
                                </div>
                                <?php } ?>
                                <div style="width:100%;padding-bottom:10px;">
                                    <?php echo $this->fetch('content'); ?>
                                </div>
                                <div style="clear:both;padding:10px 20px 40px 20px;">
                                    <table style="width:100%;border-collapse:collapse;border:0">
                                        <tbody>
                                            <tr>
                                                <td style="font-family:'Open sans','Arial',sans-serif;vertical-align:bottom">
                                                    <span style="font-size:small"><?php echo __('Best regards!'); ?><br></span><span style="font-size:x-large;line-height:1"><?php echo __('OnneBlue Team'); ?></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="direction:ltr;color:#777;font-size:0.8em;border-radius:1em;padding:1em;margin:0 auto 4% auto;font-family:'Arial','Helvetica',sans-serif;text-align:center"><?php echo __('%s OnneBlue', date('Y')); ?><div class="yj6qo"></div><div class="adL"><br></div></div>
        </div>
    </div>
</body>
</html>