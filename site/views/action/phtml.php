<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

//Display partial views
class SyspatViewsActionPhtml extends JViewHTML
{

    function render()
    {
    	$this->_actionEntryView = SyspatHelpersView::load('Action','_entry','phtml');

    	return parent::render();
 	}
}