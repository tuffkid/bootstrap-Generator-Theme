  public function executeUpdate(sfWebRequest $request)
  {
    $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
<?php echo isset($this->params['disable_form_customization']) && $this->params['disable_form_customization'] ? '' : $this->getFormCustomization('edit') ?>

    $this->forwardIf($this-><?php echo $this->getSingularName() ?>->hasBehavior('justimmo_credential') && !$this-><?php echo $this->getSingularName() ?>->cbCanEdit(), sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
