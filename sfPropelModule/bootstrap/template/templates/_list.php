<div class="bg_clear"></div>
<div class="sf_admin_list">
  [?php if (!$pager->getNbResults()): ?]
    <div class="attention"><p>[?php echo __('No result', array(), 'sf_admin') ?]</p></div>
  [?php else: ?]
    <div class="bg_listTop">
        <div class="bg_listResultIndicator">
            [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
            [?php if ($pager->haveToPaginate()): ?]
                [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
            [?php endif; ?]
        </div>
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/chosen_datasets', array('helper' => $helper)) ?]
        <?php endif; ?>
        [?php if ($pager->haveToPaginate()): ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
      [?php endif; ?]
      <div class="bg_clear"></div>
    </div>
    <table cellspacing="0" class="sf_list_table">
      <thead>
        <tr class="bg_tableHead">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
<?php endif; ?>
          [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]
<?php if ($this->configuration->getValue('list.object_actions')): ?>
          <th id="sf_admin_list_th_actions"></th>
<?php endif; ?>
        </tr>
      </thead>
      <tbody>
        [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
          <tr class="sf_admin_row [?php echo $odd ?]">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
<?php if ($this->configuration->getValue('list.object_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
          </tr>
        [?php endforeach; ?]
      </tbody>
    </table>
    <div class="bg_listBottom">
        [?php if ($pager->haveToPaginate()): ?]
            [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
        [?php endif; ?]
        <div class="bg_listResultIndicator">
            [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
            [?php if ($pager->haveToPaginate()): ?]
                [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
            [?php endif; ?]
        </div>
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/chosen_datasets', array('helper' => $helper)) ?]
        <?php endif; ?>
        <div class="bg_clear"></div>
    </div>
  [?php endif; ?]
</div>
<script type="text/javascript">
function checkAll()
{
    var checked = jQuery('#sf_admin_list_batch_checkbox').attr('checked');
    jQuery('.sf_admin_list input[type="checkbox"].sf_admin_batch_checkbox').each(function(){
        var ele = jQuery(this);
        if(checked == 'checked') {
            ele.attr('checked', 'checked');
        } else {
            ele.removeAttr('checked');
        }
    });
    jQuery.ajax({
        url: '[?php echo url_for("<?php echo $this->getModuleName()?>/remoteBatchAll") ?]',
        data: 'checked='+checked,
        complete: function(XMLHttpRequest) {
            jQuery('.chosen_datasets').replaceWith(XMLHttpRequest.responseText);
        }
    });
}

function checkOne(id)
{
    jQuery.ajax({
        url: '[?php echo url_for("<?php echo $this->getModuleName()?>/remoteBatchToggle") ?]',
        data: 'id='+id,
        complete: function(XMLHttpRequest) {
            jQuery('.chosen_datasets').replaceWith(XMLHttpRequest.responseText);
        }
    });
}
</script>
