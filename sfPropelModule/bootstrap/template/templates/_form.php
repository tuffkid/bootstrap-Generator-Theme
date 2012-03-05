[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div>
    [?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>') ?]
        [?php echo $form->renderHiddenFields(false) ?]

        [?php if ($form->hasGlobalErrors()): ?]
            [?php echo $form->renderGlobalErrors() ?]
        [?php endif; ?]

        [?php if($configuration->getFormTabs($form->isNew() ? 'new' : 'edit')) : ?]
            <div id="form_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
                [?php if($configuration->getFormTabs()) : ?]
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        [?php foreach($configuration->getFormTabs($form->isNew() ? 'new' : 'edit') as $name => $tab) : ?]
                            [?php if(!isset($tab['credentials']) || $sf_user->hasCredential($tab['credentials'])) : ?]
                                <li id="li_[?php echo $name ?]" class="ui-state-default ui-corner-top"><a href="#[?php echo $name ?]">[?php echo $tab['label'] ?]</a></li>
                            [?php endif; ?]
                        [?php endforeach; ?]
                    </ul>

                    [?php foreach($configuration->getFormTabs($form->isNew() ? 'new' : 'edit') as $name => $tab) : ?]
                        [?php if(!isset($tab['credentials']) || $sf_user->hasCredential($tab['credentials'])) : ?]
                            <div class="bg_tab" id="[?php echo $name ?]">
                                [?php foreach ($configuration->getFormFieldsForTab($name, $form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
                                    [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
                                [?php endforeach; ?]
                            </div>
                        [?php endif; ?]
                    [?php endforeach; ?]
                [?php endif; ?]
            </div>
            <input type="hidden" value="[?php echo $sf_request->getParameter('selected_form_tab', 0) ?]" id="selected_form_tab" name="selected_form_tab" />
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    jQuery('#form_tabs').tabs({
                        selected: [?php echo $sf_request->getParameter('selected_form_tab', 0) ?],
                        select: function(event, ui) {
                            jQuery('#selected_form_tab').val(ui.index);
                            jQuery('.sf_admin_action_previous > a, .sf_admin_action_next > a').each(function() {
                                jQuery(this).attr('href', generatorReplaceUrlParam(jQuery(this).attr('href'), 'selected_form_tab', ui.index));
                            });
                        }
                    });
                    jQuery('#form_tabs').find('.error_list, .errors').parents('.bg_tab').each(function() {
                        jQuery('#li_'+jQuery(this).attr('id')).addClass('bg_tabError');
                    });
                });
            </script>
        [?php else: ?]
            [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
                [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
            [?php endforeach; ?]
        [?php endif; ?]
    </form>
</div>

<div id="sf_admin_sidebar">
    <div class="sf_admin_sidebar_actions">
        [?php include_partial('<?php echo $this->getModuleName() ?>/sidebar_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
    </div>
    [?php include_partial('<?php echo $this->getModuleName() ?>/sidebar', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
</div>
