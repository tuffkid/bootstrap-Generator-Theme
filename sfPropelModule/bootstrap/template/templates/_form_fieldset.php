<fieldset>
    <legend>
        [?php if ('NONE' != $fieldset): ?]
            [?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]
        [?php else: ?]
            [?php echo __($this->getModuleName(), array(), '<?php echo $this->getI18nCatalogue() ?>') ?]
        [?php endif; ?]
    </legend>

    [?php foreach ($fields as $name => $field): ?]
        [?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/form_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => '',
        )) ?]
    [?php endforeach; ?]
</fieldset>
