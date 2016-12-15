<li class="dropdown">
<?php
switch ($siLanguage['iso-639-1']) {
    case 'por':
        $flag = $this->Html->image('languages/por.png',
            array(
                'alt' => 'Português',
                'title' => 'Português'
            )
        );
        break;
    case 'eng':
        $flag = $this->Html->image('languages/eng.png',
            array(
                'alt' => 'Português',
                'title' => 'Português'
            )
        );
        break;
    default:
        $flag = $this->Html->image('languages/eng.png',
            array(
                'alt' => 'Português',
                'title' => 'Português'
            )
        );
        break;
}
echo $this->Html->link(__('%s', $flag), '#',
    array(
        'class' => 'dropdown-toggle no-padding',
        'data-toggle' => 'dropdown',
        'escape' => false
    )
);
?>
<ul class="dropdown-menu">
    <li>
        <?php 
        $flagPor = $this->Html->image('languages/por.png',
            array(
                'alt' => 'Português',
                'title' => 'Português'
            )
        );
        echo $this->Html->link($flagPor.' Português', 
            array(
                'admin' => false,
                'controller' => 'pages', 
                'action' => 'language',
                'plugin' => false,
                'por'
            ),
            array(
                'escape' => false,
            )
        );

        $flagEng = $this->Html->image('languages/eng.png',
            array(
                'alt' => 'English',
                'title' => 'English'
            )
        );
        echo $this->Html->link($flagEng.' English', 
            array(
                'admin' => false,
                'controller' => 'pages', 
                'action' => 'language',
                'plugin' => false,
                'eng'
            ),
            array(
                'escape' => false
            )
        );
        ?>
    </li>
</ul>
</li>