<div style="padding:10px 20px">
    <table width="100%">
        <tr>
            <td><span style="font-family:'Open sans','Arial',sans-serif;font-size:2.08em"><?php echo __('Last step to start using OnneBlue'); ?></span></td>
        </tr>
        <tr>
            <td><?php echo __('Please, click on the link below to confirm registration: '); ?></td>
        </tr>
        <tr>
            <td height="60px" align="center">
                <?php
                echo $this->Html->link(__('Confirm account'),
                        Router::url(
                            array(
                                'controller' => 'users',
                                'action' => 'verify',
                                't' => $hash,
                                'n' => $username
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
    </table>
</div>