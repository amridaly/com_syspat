<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
//sessions
jimport( 'joomla.session.session' );
 
//load tables
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

//load classes
JLoader::registerPrefix('Syspat', JPATH_COMPONENT);

//Load plugins
JPluginHelper::importPlugin('syspat');

//Load styles and javascripts
SyspatHelpersStyle::load();

//application
$app = JFactory::getApplication();
$router = $app->getRouter();
$router->setMode(0);
// Require specific controller if requested
$controller = $app->input->get('controller','default');

// Create the controller
$classname  = 'SyspatControllers'.ucwords($controller);
$controller = new $classname();
 
// Perform the Request task
$controller->execute();

