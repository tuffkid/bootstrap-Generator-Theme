<?php if ($listActions = $this->configuration->getValue('list.batch_actions')): ?>
    <div class="sf_admin_batch_actions_choice">
        <ul>
            <li><strong>[?php echo __('All chosen datasets', array(), 'sf_admin') ?]: </strong></li>
        <?php foreach ((array) $listActions as $action => $params): ?>
            <li>
            <?php if($action == 'batchDelete') : ?>
                <?php echo $this->addCredentialCondition('[?php echo link_to(__(\''.$params['label'].'\', array(), \'sf_admin\'), $helper->getUrlForAction("collection"), array("action" => "batch", "batch_action" => "batchDelete"), array("post" => true, "confirm" => __("Are you sure?", null, "sf_admin"))) ?]', $params) ?>
            <?php else: ?>
                <?php echo $this->addCredentialCondition('[?php echo link_to(__(\''.$params['label'].'\', array(), \'sf_admin\'), $helper->getUrlForAction("collection"), array("action" => "batch", "batch_action" => "'.(isset($params['action']) ? $params['action'] : $action) .'"), array("post" => true)); ?]', $params) ?>
            <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
