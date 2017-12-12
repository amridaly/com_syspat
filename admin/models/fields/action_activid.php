<?php

defined('_JEXEC') or die;
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 

class JFormFieldBookAuthorId extends JFormFieldList{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Action_activId';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions(){
		
		$option = array(); //prevent problems
	 
	    $option['driver']   = 'mysql';           // Database driver name
	    $option['host']     = 'localhost'; // Database host name
	    $option['user']     = 'root';            // User for database authentication
	    $option['password'] = '';   // Password for database authentication
	    $option['database'] = 'syspat';   // Database name
	    $option['prefix']   = '';            // Database prefix (may be empty)
	
        $db = JDatabaseDriver::getInstance($option);
		
		//$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('`ID_ACTION_ACTIV` as `key`, `DESCRIPTION` as `value`');
		$query->from('`action_activ`');
		$query->order('`DESCRIPTION`');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$options = array();
		if ($rows){
			foreach($rows as $row){
				$options[] = JHtml::_('select.option', $row->key, $row->value);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}
