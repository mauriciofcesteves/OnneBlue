<?php
if (isset($this->params['plugin']) === true) {
    $controller = $globalPermissions['@plugin'][Inflector::camelize($this->params['plugin'])][$this->params['controller']];
} else {
    $controller = $globalPermissions['@core'][$this->params['controller']];
}

if (
    (isset($controller['admin_view']['active']) === true && $controller['admin_view']['active'] === true) ||
    (isset($controller['admin_edit']['active']) === true && $controller['admin_edit']['active'] === true) ||
    (isset($controller['admin_delete']['active']) === true && $controller['admin_delete']['active'] === true)
) { 
?>
	<th class="actions col-xs-5 col-sm-4 col-md-3"><?php echo __('Actions'); ?></th>
<?php } ?>