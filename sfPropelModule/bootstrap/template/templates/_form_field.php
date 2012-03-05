[?php if ($field->isPartial()): ?]
    [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php elseif ($field->isComponent()): ?]
    [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?]
[?php else: ?]
    <div class="[?php echo $class ?][?php $form[$name]->hasError() and print ' errors' ?]">
        [?php echo $form[$name]->renderError() ?]

        [?php echo $form[$name]->renderLabel($label) ?]
        <div class="sf_admin_form_row_data">[?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?]<div class="bg_clear"></div></div>

        [?php if ($help): ?]
            <div class="help">[?php echo __($help, array(), 'sf_admin') ?]</div>
        [?php elseif ($help = $form[$name]->renderHelp()): ?]
            <div class="help">[?php echo $help ?]</div>
        [?php endif; ?]
    </div>
[?php endif; ?]
