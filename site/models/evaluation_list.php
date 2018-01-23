<?php
defined('_JEXEC') or die;

class SyspatModelEvaluation_list extends JModelLegacy
{
	/**
	 * Action_activ_list data array for tmp store
	 *
	 * @var array
	 */
	private $_data;

	/**
	* Pagination object
	* @var object
	*/
	private $_pagination = null;

	/*
	 * Constructor
	 *
	 */
	function __construct(){
		parent::__construct();

		$app = JFactory::getApplication();

        // Get pagination request variables
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);

	}

	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData(){
		// Lets load the data if it doesn't already exist
	if (empty( $this->_data )){
	    $option = array(); //prevent problems
	 
	    $option['driver']   = 'mysql';           // Database driver name
	    $option['host']     = 'localhost'; // Database host name
	    $option['user']     = 'root';            // User for database authentication
	    $option['password'] = '';   // Password for database authentication
	    $option['database'] = 'syspat';   // Database name
	    $option['prefix']   = '';            // Database prefix (may be empty)
	
        $db = JDatabaseDriver::getInstance($option);

        $query = $db->getQuery(true);
        $query
	    ->select(array('e.ID_EVAL_ACTION_ACTIV,e.EVAL_ACT_DATE,a.ACTION_ACTIV_REF,a.DOMAIN_CODE,a.DIMENSION_CODE,a.DESCRIPTION,i.INDICATOR_PEFA_CODE'))
        ->from($db->quoteName('eval_action_activ', 'e'))
        ->join('INNER', $db->quoteName('action_activ', 'a') . ' ON (' . $db->quoteName('e.ACTION_ACTIV_REF') . ' = ' . $db->quoteName('a.ACTION_ACTIV_REF') . ')')
	    ->join('LEFT', $db->quoteName('indicator_pefa', 'i') . ' ON (' . $db->quoteName('e.ID_EVAL_ACTION_ACTIV') . ' = ' . $db->quoteName('i.ID_EVAL_ACTION_ACTIV') . ')');

	    $this->_data = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit') );
		}
	 return $this->_data;
	}

	/**
	 * Gets the number of published records
	 * @return int
	 */
	public function getTotal(){
		$option = array(); //prevent problems
	 
	    $option['driver']   = 'mysql';           // Database driver name
	    $option['host']     = 'localhost'; // Database host name
	    $option['user']     = 'root';            // User for database authentication
	    $option['password'] = '';   // Password for database authentication
	    $option['database'] = 'syspat';   // Database name
	    $option['prefix']   = '';            // Database prefix (may be empty)
	
        $db = JDatabaseDriver::getInstance($option);

        $query = $db->getQuery(true);
        $query
	    ->select('COUNT(*)')
            ->from($db->quoteName('eval_action_activ', 'e'));

		$db->setQuery($query);
		return $db->loadResult();
	}
	
	/**
	 * Gets the Pagination Object
	 * @return object JPagination
	 */
	public function getPagination(){
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
  /**
  public function getListQuery()
  {
	  $option = array(); //prevent problems
	 
	$option['driver']   = 'mysql';           // Database driver name
	$option['host']     = 'localhost'; // Database host name
	$option['user']     = 'root';            // User for database authentication
	$option['password'] = '';   // Password for database authentication
	$option['database'] = 'syspat';   // Database name
	$option['prefix']   = '';            // Database prefix (may be empty)
	
    $db = JDatabaseDriver::getInstance($option);

    $query = $db->getQuery(true);
    $query
	->select(array('e.ID_EVAL_ACTION_ACTIV,e.EVAL_ACT_DATE,a.ACTION_ACTIV_REF,a.DOMAIN_CODE,a.DIMENSION_CODE,a.DESCRIPTION,i.INDICATOR_PEFA_CODE'))
    ->from($db->quoteName('eval_action_activ', 'e'))
    ->join('INNER', $db->quoteName('action_activ', 'a') . ' ON (' . $db->quoteName('e.ACTION_ACTIV_REF') . ' = ' . $db->quoteName('a.ACTION_ACTIV_REF') . ')')
	->join('LEFT', $db->quoteName('indicator_pefa', 'i') . ' ON (' . $db->quoteName('e.ID_EVAL_ACTION_ACTIV') . ' = ' . $db->quoteName('i.ID_EVAL_ACTION_ACTIV') . ')');
    return $query;
  }
  **/
}