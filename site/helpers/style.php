<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class SyspatHelpersStyle
{
	static function load()
	{
		$document = JFactory::getDocument();

		$document->addStyleSheet(JURI::base().'/media/jui/css/bootstrap.min.css');
		$document->addStylesheet(JURI::base().'components/com_syspat/assets/css/style.css');
		//javascripts
	
		$document->addScript(JURI::base().'components/com_syspat/assets/js/syspat.js');

	}
}