<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

/** debug
ini_set( 'display_errors', true );
error_reporting( E_ALL );
*/

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_syspat')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$views = explode(',', 'action_activ_list,evaluation_list');
$view = $views[0];

/*
Please note there are known issues with JInput and Magic Quotes (Deprecated in PHP 5.3.0 and removed in PHP 5.4.0). 
Most servers have these turned off - however it is important to bear this in mind whilst developing a component. 
For this reason all core components in Joomla 2.5.x still use JRequest. 
As of Joomla 3.0+ magic quotes is required to be disabled and thus this is no longer an issue. 

http://docs.joomla.org/Retrieving_request_data_using_JInput

*/


$jinput = JFactory::getApplication()->input;
$view = $jinput->get('view', $view, 'CMD');
$jinput->set('view', $view);



if (in_array($view, $views)) foreach($views as $v){
	$link = JRoute::_("index.php?option=com_syspat&view={$v}");
	$selected = ($v == $view);
	//JSubMenuHelper::addEntry(JText::_( strtoupper('com_syspat_MENU_' . $v) ), "index.php?option=com_syspat&view={$v}", $selected);
	JSubMenuHelper::addEntry(JText::_( strtoupper($v) ), "index.php?option=com_syspat&view={$v}", $selected);
}

// Require the base controller
//require_once( JPATH_COMPONENT.DS.'controller.php' );

// import joomla controller library
jimport('joomla.application.component.controller');

// Create the controller
$controller = JControllerLegacy::getInstance('Syspat');

// Perform the Request task
$controller->execute($jinput->get('task', '', 'CMD')); // or CMD ??


// Redirect if set by the controller
$controller->redirect();