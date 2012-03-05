[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div class="row-fluid">
    <div class="span12">
        <div class="page-header">
            <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="" style="text-align: right;">
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager)) ?]
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php if($this->configuration->hasFilterForm()): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration)) ?]
        <?php endif; ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
        <?php if($this->configuration->getValue('list.batch_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
        <?php endif; ?>
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_max_per_page', array('helper' => $helper, 'configuration' => $configuration, 'value' => $pager->getMaxPerPage())) ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager)) ?]
    </div>
</div>
