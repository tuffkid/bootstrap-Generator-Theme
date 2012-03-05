<ul class="sf_admin_actions no_margin">
<?php foreach (array('edit') as $action): ?>
<?php foreach ($this->configuration->getValue($action.'.actions') as $name => $params): ?>
<?php if ('_previous' == $name): ?>
[?php echo $helper->linkToPrevious($form->getObject(), <?php echo $this->asPhp($params)?>) ?]
<?php elseif ('_next' == $name): ?>
[?php echo $helper->linkToNext($form->getObject(), <?php echo $this->asPhp($params)?>) ?]
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
</ul>
