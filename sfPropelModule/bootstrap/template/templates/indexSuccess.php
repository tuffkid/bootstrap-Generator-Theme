[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">
    <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>

    <div id="sf_admin_header">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
    </div>

    <div>
        <?php if ($actions = $this->configuration->getValue('list.actions')): ?>
            <?php foreach ($actions as $name => $params): ?>
                <?php if ('_new' == $name): ?>
                    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToNew('.$this->asPhp($params).') ?]', $params) ?>
                    <?php break; ?>
                <?php else: ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

    <?php if ($this->configuration->hasFilterForm()): ?>
        <div id="sf_admin_bar">
            [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
        </div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
        <?php endif; ?>

        [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
            <ul class="unstyled">
                [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper, 'pager' => $pager)) ?]
                [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
            </ul>

        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            </form>
        <?php endif; ?>
    </div>

    <div id="sf_admin_footer">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
    </div>
</div>
