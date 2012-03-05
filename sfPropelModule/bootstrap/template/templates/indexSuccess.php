[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">

    <ul class="sf_admin_actions">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </ul>

    <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>

    <div class="bg_clear"></div>

    [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

    <div id="sf_admin_header">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
    </div>

    <?php if($this->configuration->hasFilterForm()): ?>
        [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
    <?php endif; ?>

    <div id="sf_admin_content">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
        <?php if($this->configuration->getValue('list.batch_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
        <?php endif; ?>
        <ul class="sf_admin_actions">
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_max_per_page', array('helper' => $helper, 'configuration' => $configuration, 'value' => $pager->getMaxPerPage())) ?]
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
        </ul>
    </div>

    <div id="sf_admin_footer">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
    </div>
</div>
