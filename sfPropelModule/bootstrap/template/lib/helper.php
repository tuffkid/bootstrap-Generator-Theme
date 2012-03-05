[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }

  public function linkToShow($object, $params)
  {
    return '<li class="sf_admin_action_show">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', $this->getUrlForAction('show'), $object).'</li>';
  }

  public function linkToPrevious($object, $params)
  {
    if(!$object->isNew())
    {
        $user = sfContext::getInstance()->getUser();
        $tab = $user->hasFlash('selected_form_tab') ? '&selected_form_tab='.$user->getFlash('selected_form_tab') : '';
        return '<li class="sf_admin_action_previous">'.link_to('<span>'.__($params['label'], null, 'sf_admin').'</span>', '@<?php echo $this->getUrlForAction('object') ?>?action=previous&id='.$object->getPrimaryKey().$tab).'</li>';
    }
    return '';
  }

  public function linkToNext($object, $params)
  {
    if(!$object->isNew())
    {
        $user = sfContext::getInstance()->getUser();
        $tab = $user->hasFlash('selected_form_tab') ? '&selected_form_tab='.$user->getFlash('selected_form_tab') : '';
        return '<li class="sf_admin_action_next">'.link_to('<span>'.__($params['label'], null, 'sf_admin').'</span>', '@<?php echo $this->getUrlForAction('object') ?>?action=next&id='.$object->getPrimaryKey().$tab).'</li>';
    }
    return '';
  }

  public function linkToSave($object, $params)
  {
    return '<li class="sf_admin_action_save"><a href="#" onclick="jQuery(\'#sf_admin_form_<?php echo $this->getModuleName() ?> form:first\').submit();return false"><span>'. __($params['label'], array(), 'sf_admin').'</span></a></li>';
  }

  public function linkToNew($params)
  {
    return '<li class="sf_admin_action_new">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', '@'.$this->getUrlForAction('new')).'</li>';
  }

  public function linkToEdit($object, $params)
  {
    return '<li class="sf_admin_action_edit">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', $this->getUrlForAction('edit'), $object).'</li>';
  }

  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    return '<li class="sf_admin_action_delete">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'])).'</li>';
  }

  public function linkToList($params)
  {
    return '<li class="sf_admin_action_list">'.link_to('<span>'.__($params['label'], array(), 'sf_admin').'</span>', '@'.$this->getUrlForAction('list')).'</li>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li class="sf_admin_action_save_and_add"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" /></li>';
  }

    public function toggleBatchId($id)
    {
        if($this->hasBatchId($id))
        {
            $this->removeBatchId($id);
        }
        else
        {
            $this->addBatchId($id);
        }
    }

    public function removeBatchId($id)
    {
        $this->setBatchIds(array_filter($this->getBatchIds(), function ($element) use ($id) { return ($element != $id); }));
    }

    public function addBatchId($id)
    {
        if(!$this->hasBatchId($id))
        {
            $ids = $this->getBatchIds();
            $ids[] = $id;
            $this->setBatchIds($ids);
        }
    }

    public function hasBatchId($id)
    {
        $ids = $this->getBatchIds();
        return in_array($id, $ids);
    }

    public function getBatchIds()
    {
        return sfContext::getInstance()->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.batch', array(), 'admin_module');
    }

    public function setBatchIds($ids = array())
    {
        return sfContext::getInstance()->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.batch', $ids, 'admin_module');
    }

    public function countBatchIds($ids = array())
    {
        return count($this->getBatchIds());
    }
}
