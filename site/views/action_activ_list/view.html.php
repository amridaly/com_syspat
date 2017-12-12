<?php
defined('_JEXEC') or die;

class SyspatViewAction_activ_list extends JViewLegacy
{
	function display($tpl = null){
		$app = JFactory::getApplication();
		/*
		// load component parameters
		$params = JComponentHelper::getParams( 'com_mybooks' );
		$params = $app->getParams( 'com_mybooks' );	
		$dummy = $params->get( 'dummy_param', 1 ); 

		// load another model
		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_mybooks/models');
		$otherModel = JModelLegacy::getInstance( 'Record', 'RecordModel' );
		*/
	
		$data = $this->get('Data');
		$this->assignRef('data', $data);
		
		$pagination = $this->get('Pagination');
		$this->assignRef('pagination', $pagination);

		parent::display($tpl);
	}
	/**
  public function display($tpl = null)
  {
    //Nous récupérons les enregistrement en faisant appel au modèle
    $actions = $this->get('Items');
    $this->actions = &$actions;
    
    parent::display($tpl);
    
  }
  **/
}