  public function executeDelete(sfWebRequest $request)
  {
    $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $request->checkCSRFProtection();

    $this->forwardIf($this-><?php echo $this->getSingularName() ?>->hasBehavior('justimmo_credential') && !$this-><?php echo $this->getSingularName() ?>->cbCanDelete(), sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
