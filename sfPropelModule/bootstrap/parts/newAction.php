  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();

          //Ausgabe des Form Titles im html Title um User einfacher das Stöbern in Tabs zu ermöglichen. Props 2 Harry :)
          sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
          $<?php echo $this->getSingularName() ?> = $this-><?php echo $this->getSingularName() ?>;
          $this->getResponse()->setTitle( <?php echo $this->getI18NString('edit.title') ?>);

<?php echo isset($this->params['disable_form_customization']) && $this->params['disable_form_customization'] ? '' : $this->getFormCustomization('new') ?>
  }
