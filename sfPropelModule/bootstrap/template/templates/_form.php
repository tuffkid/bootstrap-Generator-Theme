[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div>
    [?php echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', array('class' => 'form-horizontal')) ?]
        [?php echo $form->renderHiddenFields(false) ?]

        [?php if ($form->hasGlobalErrors()): ?]
            [?php echo $form->renderGlobalErrors() ?]
        [?php endif; ?]

        [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
            [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?]
        [?php endforeach; ?]
    </form>
</div>

<div id="sf_admin_sidebar">
    <div class="sf_admin_sidebar_actions">
        [?php include_partial('<?php echo $this->getModuleName() ?>/sidebar_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
    </div>
    [?php include_partial('<?php echo $this->getModuleName() ?>/sidebar', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
</div>
