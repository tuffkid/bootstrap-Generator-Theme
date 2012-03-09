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
    private function applyButtonStyle($params)
    {
        if (array_key_exists('btn', $params))
        {
            return 'btn '.$params['btn'];
        }

        return 'btn';
    }

    public function linkToNew($params)
    {
        return link_to('<i class="icon-plus"></i> '.__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new'), array('class' => $this->applyButtonStyle($params)));
    }

    public function linkToEdit($object, $params)
    {
        return link_to('<i class="icon-pencil"></i> '.__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object, array('class' => $this->applyButtonStyle($params)));
    }

    public function linkToDelete($object, $params)
    {
        if ($object->isNew())
        {
            return '';
        }

        return link_to(
            '<i class="icon-ban-circle icon-white"></i> '.__($params['label'], array(), 'sf_admin'),
            $this->getUrlForAction('delete'),
            $object,
            array(
                'method' => 'delete',
                'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'],
                'class' => $this->applyButtonStyle($params).' btn-danger'
        ));
    }

    public function linkToList($params)
    {
        return link_to('<i class="icon-list"></i> '.__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'), array('class' => $this->applyButtonStyle($params)));
    }

    public function linkToSave($object, $params)
    {
        return '<a class="'.$this->applyButtonStyle($params).'" href="#" onclick="jQuery(\'#admin_form\').submit(); return false;"><i class="icon-ok"></i> '.__($params['label'], array(), 'sf_admin').'</a>';
    }

    public function linkToSaveAndAdd($object, $params)
    {
        return;
    }

    public function linkToSaveAndEdit($object, $params)
    {
        return '<input class="'.$this->applyButtonStyle($params).'" type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_edit" />';
    }

    public function getUrlForAction($action)
    {
        return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
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
