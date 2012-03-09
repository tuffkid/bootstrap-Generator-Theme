<?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>
    [?php echo __('what to do with the chosen ones?') ?]
    <?php foreach ((array) $listActions as $action => $params): ?>
        <?php if($action == 'batchDelete') : ?>
            <?php echo $this->addCredentialCondition('[?php echo link_to(__(\'<i class="icon-ban-circle icon-white"></i> '.$params['label'].'\', array(), \'sf_admin\'), $helper->getUrlForAction("collection"), array("action" => "batch", "batch_action" => "batchDelete"), array("class" => "btn btn-danger btn-mini", "post" => true, "confirm" => __("Are you sure?", null, "sf_admin"))) ?]', $params) ?>
        <?php else: ?>
            <?php echo $this->addCredentialCondition('[?php echo link_to(__(\''.$params['label'].'\', array(), \'sf_admin\'), $helper->getUrlForAction("collection"), array("action" => "batch", "batch_action" => "'.(isset($params['action']) ? $params['action'] : $action) .'"), array("class" => "btn btn-mini", "post" => true)); ?]', $params) ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
