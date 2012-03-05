<td>
  <ul class="sf_admin_td_actions">
<?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
<?php if ('_delete' == $name): ?>
    [?php if(!$<?php echo $this->getSingularName()?>->hasBehavior('justimmo_credential') || $<?php echo $this->getSingularName()?>->cbCanDelete()): ?]
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
    [?php endif; ?]
<?php elseif ('_edit' == $name): ?>
    [?php if($<?php echo $this->getSingularName()?>->hasBehavior('justimmo_credential')): ?]
        [?php if($<?php echo $this->getSingularName()?>->cbCanEdit()): ?]
            <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
        [?php elseif($<?php echo $this->getSingularName()?>->cbCanView()): ?]
            <?php $op = $params['label']; ?>
            <?php $params['label'] = 'Show' ?>
            <?php echo $this->addCredentialCondition('[?php echo $helper->linkToShow($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
        [?php endif; ?]
    [?php else: ?]
        <?php $params['label'] = $op ?>
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
    [?php endif; ?]
<?php else: ?>
    <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
    </li>
<?php endif; ?>
<?php endforeach; ?>
  </ul>
</td>
