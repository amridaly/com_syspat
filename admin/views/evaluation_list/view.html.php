<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );


class SyspatViewEvaluation_list extends JViewLegacy
{
	/**
	 * Action_activ_list view display method
	 * @return void
	 **/
	function display($tpl = null){
		$app = JFactory::getApplication();
		$this->user  = JFactory::getUser();

		// Get data from the model; method is getItems() in J2.5+
		$this->rows = $this->get('Items');
		$this->state = $this->get('State');
		$this->pagination = $this->get('Pagination');	
		$this->j3x = version_compare( JVERSION, '3.0', '>=' ); // is Joomla 3+

		
		// draw menu
		//'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete'
		JToolBarHelper::title( JText::_( 'com_syspat_MENU_AUTHORLIST' ), 'generic.png' );
		if($this->user->authorise('core.edit', 'com_syspat')) JToolBarHelper::editList('action_activ.edit');
		if($this->user->authorise('core.create', 'com_syspat')) JToolBarHelper::addNew('action_activ.add');
		if($this->user->authorise('core.delete', 'com_syspat')) JToolBarHelper::deleteList('', 'action_activ_list.delete');
		
	
		// SORTING get the user state of order and direction
		//  ** J1.5 now in $this->state object
		$default_order_field = 'ID_EVAL_ACTION_ACTIV';
		$lists['order_Dir'] = $app->getUserStateFromRequest('com_syspatfilter_order_Dir', 'filter_order_Dir', 'ASC');
		$lists['order'] = $app->getUserStateFromRequest('com_syspatfilter_order', 'filter_order', $default_order_field);
		$lists['search'] = $app->getUserStateFromRequest('com_syspatsearch', 'search', '');

		parent::display($tpl);
	}
	
}