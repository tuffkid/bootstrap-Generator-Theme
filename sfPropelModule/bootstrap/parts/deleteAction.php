    public function executeDelete(sfWebRequest $request)
    {
        $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
        $request->checkCSRFProtection();

        $this->forwardIf(!$this->getUser()->hasCredential($this->configuration->getCredentials($action)), sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        $this->getRoute()->getObject()->delete();

        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }
