    public function executeRemoteBatchToggle(sfWebRequest $request)
    {
        $obj = PropelQuery::from('<?php echo $this->getModelClass() ?>')->findPk($request->getParameter('id'));
        if($obj !== null)
        {
            $this->helper->toggleBatchId($obj->getPrimaryKey());
        }

        return $this->renderPartial('<?php echo $this->getModuleName() ?>/chosen_datasets', array('helper' => $this->helper));
    }

    public function executeRemoteBatchAll(sfWebRequest $request)
    {
        if($request->getParameter('checked') == 'checked')
        {
            $q = $this->buildQuery();
            $this->helper->setBatchIds($q->select($this->getPrimaryKeyPhpName($q))->find()->toArray());
        }
        else
        {
            $this->helper->setBatchIds(array());
        }

        return $this->renderPartial('<?php echo $this->getModuleName() ?>/chosen_datasets', array('helper' => $this->helper));
    }

    public function getPrimaryKeyPhpName($query)
    {
        $pks = $query->getTableMap()->getPrimaryKeys();
        $return = array();
        foreach($pks as $pk)
        {
            $return[] = $pk->getPhpName();
        }
        return count($return) === 1 ? $return[0]: $return;
}

    public function executeBatch(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        if (!$ids = $this->helper->getBatchIds())
        {
            $this->getUser()->setFlash('error', 'You must at least select one item.');
            $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
        }

        if (!$action = $request->getParameter('batch_action'))
        {
            $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');
            $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
        }

        if (!method_exists($this, $method = 'execute'.ucfirst($action)))
        {
            throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
        }

        if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
        {
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }

        $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => '<?php echo $this->getModelClass() ?>'));

        try
        {
            // validate ids
            $ids = $validator->clean($ids);
            // execute batch
            $this->$method($request);
        }
        catch (sfValidatorError $e)
        {
            $this->getUser()->setFlash('error', 'A problem occurs with the selected items.');
        }

        $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }

    protected function executeBatchDelete(sfWebRequest $request)
    {
        $ids = $this->helper->getBatchIds();

        $count = 0;
        foreach (<?php echo constant($this->getModelClass().'::PEER') ?>::retrieveByPks($ids) as $object)
        {
            $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));
            $object->delete();
            $count++;
        }

        if ($count >= count($ids))
        {
            $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
        }
        else
        {
            $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
        }

        $this->helper->setBatchIds(array());
        $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }
