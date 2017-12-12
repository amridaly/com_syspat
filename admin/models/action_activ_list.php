<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.modellist' );

class SyspatModelAction_activ_list extends JModelList{

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */

	protected function populateState($ordering = null, $direction = null){
		parent::populateState($ordering, $direction);
		
		// Adjust the context to support modal layouts.
		if ($layout = JFactory::getApplication()->input->get('layout', '', 'CMD')) {
			$this->context .= '.'.$layout;
		}
		
		$filter_order = $this->getUserStateFromRequest($this->context . '.filter.ordering', 'filter_order', 'ID_ACTION_ACTIV');
		$this->setState('filter.ordering', $filter_order);
		
		$filter_order_Dir = strtoupper($this->getUserStateFromRequest($this->context . '.filter.direction', 'filter_order_Dir', 'ASC'));
		$this->setState('filter.direction', $filter_order_Dir);
		
		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search', '');
		$this->setState('filter.search', $search);
		
		$dummy = $this->getUserStateFromRequest($this->context.'.filter.param1', 'filter_param2', '');
		$this->setState('filter.param1', $dummy);
		
		$dummy = $this->getUserStateFromRequest($this->context.'.filter.param2', 'filter_param2', '');
		$this->setState('filter.param2', $dummy);
		
	}

	/**
	 * Returns the table prefix
	 * @return string The table prefix to be used to retrieve the rows from the database
	 */
	protected function getPrefix($fieldName){
		$prefix = 'a'; 

		return $prefix;
	}

	/**
	 * Returns the 'order by' part of the query
	 * @return string the order by''  part of the query
	 */
	private function _buildQueryOrderBy() {
	    $app = JFactory::getApplication();

		// default field for records list
		$default_order_field = 'ACTION_ACTIV_REF'; 
		// Array of allowable order fields
	    $allowedOrders = explode(',','ACTION_ACTIV_REF,DOMAIN_CODE,DIMENSION_CODE'); // array('id', 'ordering', 'published'); 

		// retrive ordering info
		$filter_order = $this->getState('filter.ordering');
		$filter_order_Dir = strtoupper($this->getState('filter.direction'));

	    // validate the order direction, must be ASC or DESC
	    if ($filter_order_Dir != 'ASC' && $filter_order_Dir != 'DESC') {
			$filter_order_Dir = 'ASC';
	    }

	    // if order column is unknown use the default
	    if ((isSet($allowedOrders)) && !in_array($filter_order, $allowedOrders)){
			$filter_order = $default_order_field;
	    }

		$prefix = $this->getPrefix($filter_order); 

	    // return the ORDER BY clause        
	    return " `{$prefix}`.`{$filter_order}` {$filter_order_Dir}";
	}	
	
	
	private function _buildQueryWhere() {
		$db = JFactory::getDBO();
		$search = $this->getState('filter.search');
		
		$whereSearch = '';
		$whereCond='';
		
	    if ($search){
			$sa = array();
			$allowedSearch = explode(',','ACTION_ACTIV_REF,DOMAIN_CODE,DIMENSION_CODE'); // array('id', 'ordering', 'published'); 
			foreach($allowedSearch as $field){
				if (!$field) return '';
				$prefix = $this->getPrefix($field);
				$sa[] = "(`{$prefix}`.`{$field}` LIKE " . $db->quote('%' . $search . '%') . ")";
			}
			if(count($sa)) $whereSearch = " AND (" .implode(" OR ", $sa) .")";
		}		
		
		if(false){
			$condA = array();
			if($param1=$this->getState('filter.param1')){
				$field = 'field1FromTable2';
				$prefix = $this->getPrefix($field);
				$param2 = $db->quote($param1);
				$condA[]= " (`{$prefix}`.`{$field}` = {$param1}) ";
			}
			if($param2=$this->getState('filter.param2')){
				$field = 'field1FromTable3';
				$prefix = $this->getPrefix($field);
				$param2 = $db->quote($param2);
				$condA[]= " (`{$prefix}`.`{$field}` = {$param2}) ";
			}
			if(count($condA))$whereCond = " AND (" .implode(" AND ", $condA) .")";
		}
		$returnValue = " (1=1) {$whereSearch} {$whereCond}";
		
	    return $returnValue;		
	}
	
	
	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	public function getListQuery(){
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
	    ->select(array('a.ID_ACTION_ACTIV,a.ACTION_ACTIV_REF,a.DOMAIN_CODE,a.DIMENSION_CODE,a.DESCRIPTION,a.PERTINENCE,a.IS_RENEWAL,a.FREQUENCY,a.STATUS_CODE,a.PROGRESS','ap.START_DATE,ap.DUE_DATE','i.INDICATOR_PEFA_CODE'))
        ->from($db->quoteName('action_activ', 'a'))
        ->join('LEFT', $db->quoteName('act_periods', 'ap') . ' ON (' . $db->quoteName('a.ACTION_ACTIV_REF') . ' = ' . $db->quoteName('ap.ACTION_ACTIV_REF') . ')')
	    ->join('LEFT', $db->quoteName('action_activ_has_indic_pefa', 'p') . ' ON (' . $db->quoteName('a.ACTION_ACTIV_REF') . ' = ' . $db->quoteName('p.ACTION_ACTIV_REF') . ')')
	    ->join('LEFT', $db->quoteName('indicator_pefa', 'i') . ' ON (' . $db->quoteName('p.INDICATOR_PEFA_CODE') . ' = ' . $db->quoteName('i.INDICATOR_PEFA_CODE') . ')')
		
		->where($this->_buildQueryWhere())
		->order($this->_buildQueryOrderBy());
		//JFactory::getApplication()->enqueueMessage($query);
		return $query;
	}
	
		
	/**
	 * Methods to get records data for specific fields
	 * use returned recorset to populate view in specific
	 * select to manage related tables
	 * @return object list with options array
	 */
	public function getGenericFieldName($fieldName){
		$db = JFactory::getDBO();
		$db->setQuery( 'SELECT author_id AS value `$fieldName` AS text FROM `#__mybook_authors` ORDER BY `$fieldName`');
		$options = array();
		foreach( $db->loadObjectList() as $r){
			$options[] = JHTML::_('select.option',  $r->value, $r->text );
        }
		return $options;

	}
	
	public function &getNameFieldData(){
		$db =& JFactory::getDBO();
		$db->setQuery( 'SELECT `author_id` AS value, `name` AS text FROM `#__mybook_authors` ORDER BY name');
		$options = array();
		foreach( $db->loadObjectList() as $r){
			$options[] = JHTML::_('select.option',  $r->value, $r->text );
		}
		return $options;
	}


}