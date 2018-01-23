<?php

defined('_JEXEC') or die;

class SyspatHelpersSyspat
{
	public static $extension = 'com_syspat';

	/**
	 * @return  JObject
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_syspat';
		$level = 'component';

		$actions = JAccess::getActions('com_syspat', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}
}