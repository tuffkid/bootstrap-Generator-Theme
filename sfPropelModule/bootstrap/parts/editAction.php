  public function executeEdit(sfWebRequest $request)
  {
    if($this->getUser()->hasFlash('selected_form_tab'))
    {
      $request->setParameter('selected_form_tab', $this->getUser()->getFlash('selected_form_tab'));
    }
    $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();

    //we don't have a show actions, we use form so edit checks only view credential (update still checks edit credential)
    $this->forwardIf($this-><?php echo $this->getSingularName() ?>->hasBehavior('justimmo_credential') && !$this-><?php echo $this->getSingularName() ?>->cbCanView(), sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));

          //Ausgabe des Form Titles im html Title um User einfacher das Stöbern in Tabs zu ermöglichen. Props 2 Harry :)
          sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
          $<?php echo $this->getSingularName() ?> = $this-><?php echo $this->getSingularName() ?>;
          $this->getResponse()->setTitle( <?php echo $this->getI18NString('edit.title') ?>);

    $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
<?php echo isset($this->params['disable_form_customization']) && $this->params['disable_form_customization'] ? '' : $this->getFormCustomization('edit') ?>
  }
