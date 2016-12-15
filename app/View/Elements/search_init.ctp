<?php 
echo $this->Form->create('Search', 
	array(
		'url' => array(
			'controller' => $this->params['controller'], 
			'action' => $this->params['action']
		),
		'novalidate'
	)
); 
?>