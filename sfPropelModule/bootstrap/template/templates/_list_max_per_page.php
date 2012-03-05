[?php $widget = new sfWidgetFormChoice(array('choices' => $configuration->getMaxPerPages())); ?]
<li class="sf_admin_action_max_per_page">
    [?php echo __('Entries per page', null, 'sf_admin') ?] [?php echo $widget->render('max_per_page', $value, array('onchange' => "generatorMaxPerPage(value)")) ?]
</li>