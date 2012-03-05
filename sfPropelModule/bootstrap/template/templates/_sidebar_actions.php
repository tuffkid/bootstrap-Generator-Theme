<ul class="sf_admin_actions no_margin">
<?php foreach (array('new', 'edit') as $action): ?>
<?php if ('new' == $action): ?>
[?php if ($form->isNew()): ?]
<?php else: ?>
[?php else: ?]
<?php endif; ?>
<?php foreach (array_reverse($this->configuration->getValue($action.'.actions')) as $name => $params): ?>
<?php if ('_delete' == $name): ?>
[?php if(!$<?php echo $this->getSingularName()?>->hasBehavior('justimmo_credential') || $<?php echo $this->getSingularName()?>->cbCanDelete()): ?]
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
[?php endif; ?]
<?php elseif ('_list' == $name): ?>
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToList('.$this->asPhp($params).') ?]', $params) ?>
<?php elseif ('_save' == $name): ?>
[?php if($form->isNew()) : ?]
[?php if(!$<?php echo $this->getSingularName()?>->hasBehavior('justimmo_credential') || $<?php echo $this->getSingularName()?>->cbCanCreate()): ?]
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSave($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
[?php endif; ?]
[?php else: ?]
[?php if(!$<?php echo $this->getSingularName()?>->hasBehavior('justimmo_credential') || $<?php echo $this->getSingularName()?>->cbCanEdit()): ?]
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkToSave($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
[?php endif; ?]
[?php endif; ?]
<?php elseif ('_previous' == $name): ?>
<?php elseif ('_next' == $name): ?>
<?php else: ?>
  <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
[?php if (method_exists($helper, 'linkTo<?php echo $method = ucfirst(sfInflector::camelize($name)) ?>')): ?]
  <?php echo $this->addCredentialCondition('[?php echo $helper->linkTo'.$method.'($form->getObject(), '.$this->asPhp($params).') ?]', $params) ?>
[?php else: ?]
  <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
[?php endif; ?]
  </li>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
[?php endif; ?]
</ul>