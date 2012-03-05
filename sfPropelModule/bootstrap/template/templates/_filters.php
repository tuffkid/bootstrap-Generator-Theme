[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div class="sf_admin_filter">
    [?php if ($form->hasGlobalErrors()): ?]
        [?php echo $form->renderGlobalErrors() ?]
        <div class="bg_clear"></div>
    [?php endif; ?]
    <div class="sf_filter_top">
        <span>[?php echo __('Filter', null, 'sf_admin') ?]</span>
        <?php foreach ($this->configuration->getFilterActions() as $name => $params): ?>
            <?php $action = isset($params['action']) ? $params['action'] : 'filter' ?>
            <?php $qstring = isset($params['query_string']) ? $params['query_string'] : false ?>
            | [?php echo link_to('<?php echo isset($params['label']) ? $params['label'] : $name ?>', '<?php echo $this->getUrlForAction('collection') ?>', array('action' => '<?php echo $action ?>')<?php if($qstring) : ?>, array('query_string' => '<?php echo $qstring ?>')<?php endif; ?>) ?]
        <?php endforeach; ?>
        [?php if($configuration->hasHiddenFilterFields()) : ?]
            <div class="sf_admin_pagination">
                [?php echo link_to_function(__('Hide extended filters', null, 'sf_admin'), jq_remote_function(array('url' => url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'remoteToggleExtendedFilters')), 'success' => "jQuery('.bg_filterExtended, .bg_extendedFilterLink').toggle()")), array('class' => 'bg_extendedFilterLink', 'style' => $sf_user->getAttribute('<?php echo $this->getModuleName() ?>.extended_filters', false, 'admin_module') ? 'display: block;' : 'display: none;')) ?]
                [?php echo link_to_function(__('Show extended filters', null, 'sf_admin'), jq_remote_function(array('url' => url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'remoteToggleExtendedFilters')), 'success' => "jQuery('.bg_filterExtended, .bg_extendedFilterLink').toggle()")), array('class' => 'bg_extendedFilterLink', 'style' => $sf_user->getAttribute('<?php echo $this->getModuleName() ?>.extended_filters', false, 'admin_module') ? 'display: none;' : 'display: block;')) ?]
            </div>
        [?php endif; ?]
    </div>
    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter')) ?]" method="post">
        [?php echo $form->renderHiddenFields() ?]
        [?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?]
            [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
            [?php $class = 'sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name ?]
            <div class="bg_filterColumn [?php echo $class ?][?php $field->getConfig('filter') == 'hidden' and print ' bg_filterExtended' ?]"[?php $field->getConfig('filter') == 'hidden' && !$sf_user->getAttribute('<?php echo $this->getModuleName() ?>.extended_filters', false, 'admin_module') and print ' style="display: none;"' ?]>
                [?php include_partial('<?php echo $this->getModuleName() ?>/filters_field', array(
                    'name'       => $name,
                    'attributes' => $field->getConfig('attributes', array()),
                    'label'      => $field->getConfig('label'),
                    'help'       => $field->getConfig('help'),
                    'form'       => $form,
                    'field'      => $field,
                    'class'      => $class,
                )) ?]
            </div>
        [?php endforeach; ?]
        <div class="bg_clear"></div>
        <div class="sf_filter_actions">
            <input type="submit" value="[?php echo __('Filter', array(), 'sf_admin') ?]" class="bg_button white"/>
            [?php echo link_to(__('Reset', array(), 'sf_admin'), '<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?]
        </div>
    </form>
    <div class="bg_clear"></div>
</div>
