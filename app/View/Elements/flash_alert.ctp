<div id="siFlashMessage" class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <?php 

    	if (!isset($is_list_message)) {
    		$is_list_message = false;
    	}

    	if (!$is_list_message) {
	    	echo h($message); 
    	} else {
    		foreach ($messages as $key => $value) {
    			?>
    			<ul>
    				<li>
    					<?php echo h($value); ?>
    				</li>
    			</ul>
    			<?php
    		}
    	}
    ?>
</div>