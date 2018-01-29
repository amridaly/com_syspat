<?php
defined('_JEXEC') or die;

class SyspatModelsAction extends JModelBase
{
    protected $_pagination  = null;
    protected $_total       = 0;
    protected $__state    = null;
    protected $limitstart   = 0;
    protected $limit        = 10;
     
    protected function populateState($ordering = 'domain_code', $direction = 'asc')
    {
        
      $app = JFactory::getApplication();

        // List state information
        $value = $app->input->get('limit', $app->get('list_limit', 0), 'uint');
        $this->setState('list.limit', $value);

        $value = $app->input->get('limitstart', 0, 'uint');
        $this->setState('list.start', $value);
        
        $value = $app->input->get('filter_tag', 0, 'uint');
        $this->setState('filter.tag', $value);

        $orderCol = $app->input->get('filter_order', 'a.ordering');

        if (!in_array($orderCol, $this->filter_fields))
        {
                $orderCol = 'a.ordering';
        }

        $this->setState('list.ordering', $orderCol);

        $listOrder = $app->input->get('filter_order_Dir', 'ASC');

        if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', '')))
        {
                $listOrder = 'ASC';
        }

        $this->setState('list.direction', $listOrder);
        
        $params = $app->getParams();
	$this->setState('params', $params);
        
        $this->setState('layout', $app->input->getString('layout'));
        $this->setState('view', $app->input->getString('view'));
        
//    $app = JFactory::getApplication();
//       // $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
//       
//        
//        $limitstart = $app->input->getUInt('limitstart', 0);
//        // In case limit has been changed, adjust it
//        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
// 
//        $this->setState('limit', $limit);
//        $this->setState('limitstart', $limitstart);
}


  
    public function listItems()
    {
      $query = $this->getListQuery();    
     

      $list = $this->_getList($query, $this->limitstart, $this->limit);

      return $list;
    }
    
    /**
	 * Get the master query for retrieving a list of articles subject to the model state.
	 *
	 * @return  JDatabaseQuery
	 *
	 * @since   1.6
	 */
    protected function getListQuery()
    {
        // Get the current user for authorisation checks
        $user = JFactory::getUser();

        // Create a new query object.
        $db    = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('DOMAIN_LABEL,DESCRIPTION,START_DATE,DUE_DATE,STRUCTURE_LABEL');
        $query->from('#__syspat_actions ');
        $query->order(' DOMAIN_CODE ASC');

	$params= $this->getState('params');
        $orderby_sec = $params->get('orderby_sec');


	// Add the list ordering clause.
	//$query->order($this->getState('list.ordering', 'ordering') . ' ' . $this->getState('list.direction', 'ASC'));

	return $query;
    }

/**
  * Gets an array of objects from the results of database query.
  *
  * @param   string   $query       The query.
  * @param   integer  $limitstart  Offset.
  * @param   integer  $limit       The number of records.
  *
  * @return  array  An array of results.
  *
  * @since   11.1
  */
  protected function _getList($query, $limitstart = 0, $limit = 0)
  {
    $db = JFactory::getDBO();
    $db->setQuery($query, $limitstart, $limit);
    $result = $db->loadObjectList();
 
    return $result;
  }
/**
  * Returns a record count for the query
  *
  * @param   string  $query  The query.
  *
  * @return  integer  Number of rows for query
  *
  * @since   11.1
  */
  protected function _getListCount($query)
  {
    $db = JFactory::getDBO();
    $db->setQuery($query);
    $db->query();
 
    return $db->getNumRows();
  }
 
  /* Method to get model state variables
  *
  * @param   string  $property  Optional parameter name
  * @param   mixed   $default   Optional default value
  *
  * @return  object  The property where specified, the state object where omitted
  *
  * @since   11.1
  */
  public function getState($property = null, $default = null)
  {
    if (!$this->__state)
    {   
      // Protected method to auto-populate the model state.
      $this->populateState();
 
      // Set the model state set flag to true.
      $this->__state = true;
    }
 
    return $property === null ? $this->state : $this->state->get($property, $default);
  }
  
  /**
  * Get total number of rows for pagination
  */
  function getTotal() 
  {
    if ( empty ( $this->_total ) )
    {
      $query = $this->getListQuery();
      $this->_total = $this->_getListCount($query);
    }
    
    return $this->_total;
  }

  /**
  * Generate pagination
  */
  function getPagination() 
  {
    // Lets load the content if it doesn't already exist
    if (empty($this->_pagination)) 
    {
        $this->_pagination = new JPagination($this->getTotal(), $this->getState('list.start'), $this->getState('list.limit'),null,JRoute::_('index.php?view='.$this->getState('view').'&layout='.$this->getState('layout')) );
       //  $this->_pagination = new JPagination( $this->getTotal(), $this->limitstart, $this->limit);
        
     // $this->_pagination = new JPagination( $this->getTotal(), $this->getState($this->_view.'_limitstart'), $this->getState($this->_view.'_limit'),null,JRoute::_('index.php?view='.$this->_view.'&layout='.$this->_layout));
    }
     
    return $this->_pagination;
  }
}