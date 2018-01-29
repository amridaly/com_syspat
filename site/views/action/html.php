<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
jimport( 'joomla.html.pagination' );

class SyspatViewsActionHtml extends JViewHtml
{
  function render()
  {
	$app = JFactory::getApplication();
	
	$model = new SyspatModelsAction();

        $this->actions = $model->listItems();
       
        $this->_actionEntryView = SyspatHelpersView::load('action','_entry','phtml');
        
        
        
        $this->pagination = $model->getPagination();
    //display
    return parent::render();
  } 
}