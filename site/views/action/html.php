<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class SyspatViewsActionHtml extends JViewHtml
{
  function render()
  {
	$app = JFactory::getApplication();
	
	$model = new SyspatModelsAction();

        $this->actions = $model->listItems();
       
        $this->_actionEntryView = SyspatHelpersView::load('action','_entry','phtml');
    //display
    return parent::render();
  } 
}