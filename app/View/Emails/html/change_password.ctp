<div style="padding:10px 20px">
    <table width="100%">
        <tr>
            <td><span style="font-family:'Open sans','Arial',sans-serif;font-size:2.08em"><?php echo __('New password'); ?></span></td>
        </tr>
        <tr>
            <td><?php echo __('For security reasons, you must set a new password. Click the link below to set a new password: '); ?></td>
        </tr>
        <tr>
            <td height="60px" align="center">
                <?php
                echo $this->Html->link(__('Change my password'),
                        Router::url(
                            array(
                                'controller' => 'users',
                                'action' => 'change_password',
                                $token,
                                'admin' => false,
                            ), 
                            true
                        ),
                        array(
                            'style' => 'border: solid 1px #4cae4c;padding: .75em 1.5em .75em 1.5em;border-radius: .25em;margin-bottom: .5em;color: #fff;background-color: #5cb85c;text-decoration:none;',
                            'target' => '_blank'
                        )
                    );
                ?>
            </td>
        </tr>
        <tr>
        	<td><br><?php echo __('If you not asked for recover your password, disconsider this email.'); ?></td>
        </tr>
    </table>
</div>