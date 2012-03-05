    [?php if (!$pager->getNbResults()): ?]
        <p>[?php echo __('No result', array(), 'sf_admin') ?]</p>
    [?php else: ?]

        <table id="list-table" class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <?php if ($this->configuration->getValue('list.batch_actions')): ?>
                        <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
                    <?php endif; ?>

                    [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]

                    <?php if ($this->configuration->getValue('list.object_actions')): ?>
                        <th style="text-align: right;"></th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): ?]
                    <tr>
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

            <tfoot>
                <tr>
                    <td colspan="999">
                        [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
                        [?php if ($pager->haveToPaginate()): ?]
                            [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
                        [?php endif; ?]

                        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
                            [?php include_partial('<?php echo $this->getModuleName() ?>/chosen_datasets', array('helper' => $helper)) ?]
                        <?php endif; ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        [?php if ($pager->haveToPaginate()): ?]
            [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager)) ?]
        [?php endif; ?]
    [?php endif; ?]
</div>

<script type="text/javascript">
function checkAll()
{
    var checked = jQuery('#sf_admin_list_batch_checkbox').attr('checked');
    jQuery('#list-table input[type="checkbox"].sf_admin_batch_checkbox').each(function() {
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
