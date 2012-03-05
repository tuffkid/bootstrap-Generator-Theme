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
    private function buttonStyle($params)
    {
        if (array_key_exists('btn', $params))
        {
            return 'btn '.$params['btn'];
        }

        return 'btn';
    }

    public function getUrlForAction($action)
    {
        return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
    }

    public function linkToShow($object, $params)
    {
        return link_to('<i class="icon-camera"></i> '.__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('show'), $object, array('class' => $this->buttonStyle($params)));
    }

    public function linkToPrevious($object, $params)
    {
        if(!$object->isNew())
        {
            $user = sfContext::getInstance()->getUser();
            $tab = $user->hasFlash('selected_form_tab') ? '&selected_form_tab='.$user->getFlash('selected_form_tab') : '';
            return link_to(' <i class="icon-arrow-left"></i> ', '@<?php echo $this->getUrlForAction('object') ?>?action=previous&id='.$object->getPrimaryKey().$tab, array('class' => $this->buttonStyle($params)));
        }

        return '';
    }

    public function linkToNext($object, $params)
    {
        if(!$object->isNew())
        {
            $user = sfContext::getInstance()->getUser();
            $tab = $user->hasFlash('selected_form_tab') ? '&selected_form_tab='.$user->getFlash('selected_form_tab') : '';
            return link_to(' <i class="icon-arrow-right"></i> ', '@<?php echo $this->getUrlForAction('object') ?>?action=next&id='.$object->getPrimaryKey().$tab, array('class' => $this->buttonStyle($params)));
        }
        return '';
    }

    public function linkToSave($object, $params)
    {
        return '<a class="'.$this->buttonStyle($params).'" href="#" onclick="jQuery(\'#sf_admin_form_<?php echo $this->getModuleName() ?> form:first\').submit();return false"><i class="icon-refresh"></i> '. __($params['label'], array(), 'sf_admin').'</a>';
    }

    public function linkToNew($params)
    {
        return link_to('<i class="icon-plus"></i> '.__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new'), array('class' => $this->buttonStyle($params)));
    }

    public function linkToEdit($object, $params)
    {
        return link_to('<i class="icon-pencil"></i> '.__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object, array('class' => $this->buttonStyle($params)));
    }

    public function linkToDelete($object, $params)
    {
        if ($object->isNew())
        {
            return '';
        }

        return link_to('<i class="icon-remove icon-white"></i> '.__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('class' => $this->buttonStyle($params).' btn-danger', 'method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm']));
    }

    public function linkToList($params)
    {
        return link_to('<i class="icon-th-list"></i> '.__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'), array('class' => $this->buttonStyle($params)));
    }

    public function linkToSaveAndAdd($object, $params)
    {
        return null;
        if (!$object->isNew())
        {
            return '';
        }

        return '<input class="'.$this->buttonStyle($params).'" type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" />';
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
