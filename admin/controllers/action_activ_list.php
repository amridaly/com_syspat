<?php
defined('_JEXEC') or die;

class SyspatControllerAction_activ_list extends JControllerAdmin
{

	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function getModel($name = 'Action_activ', $prefix = 'SyspatModel', $cfg = array('ignore_request' => true)){
		$model = parent::getModel($name, $prefix, $cfg);
		return $model;
	}	
	
	public function doTaskList(){
	//La vue par défaut est actions la page qui va afficher la liste
    $vName = $this->input->get('view', 'action_activ_list');
    $this->input->set('view', $vName);
    
    $safeurlparams = array(
      'ID_ACTION_ACTIV'=>'INT',
    );
	}
	/**MMLBE: Example of task working on list; you need also a doTaskList in model for single object (not for list!!)
	public function doTaskList() {
        JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));// Check for request forgeries

        // Get items to do a task from the request.
		$cid = JFactory::getApplication()->input->get('cid', array(), 'array'); 

        if (empty($cid)){
            JError::raiseWarning(500, JText::_($this->text_prefix . '_NO_ITEM_SELECTED'));
        }else{
            // Get the model.
            $model = $this->getModel();

            // Make sure the item ids are integers
            JArrayHelper::toInteger($cid);

            // doTaskList the items.
            if (!$model->doTaskList($cid)){
                    JError::raiseWarning(500, $model->getError());
            }else{
                $ntext = $this->text_prefix . '_N_ITEMS_PUBLISHED';
                $this->setMessage(JText::plural($ntext, count($cid)));
            }
        }
        $extension = JRequest::getCmd('extension');
        $extensionURL = ($extension) ? '&extension=' . JRequest::getCmd('extension') : '';
        $this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $extensionURL, false));

    }	
	MMLBE*/
} 