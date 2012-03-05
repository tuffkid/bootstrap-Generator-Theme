<?php foreach (array('new', 'edit') as $action): ?>
    <?php foreach (array_reverse($this->configuration->getValue($action.'.actions')) as $name => $params): ?>
        <?php if ($action == 'new'): ?>
        <?php else: ?>
            <?php if ('_delete' == $name): ?>
                <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
            <?php elseif ('_list' == $name): ?>
                <?php echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($params).') ?]', $params) ?>
            <?php elseif ('_save' == $name): ?>
                <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSave($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
            <?php elseif ('_previous' == $name): ?>
            <?php elseif ('_next' == $name): ?>
            <?php else: ?>
                [?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::camelize($name)) ?>')): ?]
                    <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
                [?php else: ?]
                    <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
                [?php endif; ?]
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>
