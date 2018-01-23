<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class SyspatModelsCalendar extends SyspatModelsDefault
{
  var $_user_id    = null;
  var $_state_code  = 1;

  function __construct()
  {
    parent::__construct();      

    $app = JFactory::getApplication();
    $this->_user_id = $app->input->get('user_id',JFactory::getUser()->id);
  }

 function getItem() 
  {
    $calendar = parent::getItem(); 

    $calendarModel = new SyspatModelscalendar();
    $calendarModel->set('_user_id',$this->_user_id);
	
    return $calendar;
  }

  protected function _buildQuery()
  {
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('a.ACTION_ACTIV_REF,a.DESCRIPTION,a.START_DATE,a.DUE_DATE,a.STRUCTURE_CODE,a.RESPONSIBLE_NAME,a.DOMAIN_CODE,a.DIMENSION_CODE');
    $query->from('#__syspat_actions as a');
    
    //JFactory::getApplication()->enqueueMessage($query);

    return $query;

  }


  protected function _buildWhere(&$query)
  {
   // $query->where('c.state_code = '. (int) $this->_state_code);

    return $query;
  }

  
}