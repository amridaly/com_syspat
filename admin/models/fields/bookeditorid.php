<?php
/**
 * BookEditorId Form Field List class for the Mybooks component
 * 
 * @package    Mybooks
 * @subpackage com_mybooks
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 2.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */
defined('_JEXEC') or die;
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 

class JFormFieldBookEditorId extends JFormFieldList{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'BookEditorId';
 
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	protected function getOptions(){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('`editor_id` as `key`, `name` as `value`');
		$query->from('`#__mybook_editors`');
		$query->order('`name`');
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
