<?php

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


class SyspatTableAction_activ extends JTable{

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db){
		$option = array(); //prevent problems
	 
	    $option['driver']   = 'mysql';           // Database driver name
	    $option['host']     = 'localhost'; // Database host name
	    $option['user']     = 'root';            // User for database authentication
	    $option['password'] = '';   // Password for database authentication
	    $option['database'] = 'syspat';   // Database name
	    $option['prefix']   = '';            // Database prefix (may be empty)
	
        $db = JDatabaseDriver::getInstance($option);
		
		parent::__construct('action_activ', 'ID_ACTION_ACTIV', $db);
	}
	
	function check(){
		// write here data validation code
		return parent::check();
	}

	function bind($src, $ignore = array()){
		// source value is an array or object.
		return parent::bind($src, $ignore);
	}

	function store($updateNulls = false) {
		// $updateNulls: True to update fields even if they are null.
		return parent::store($updateNulls);
	}
}