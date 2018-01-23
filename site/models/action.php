<?php
defined('_JEXEC') or die;

class SyspatModelsAction extends SyspatModelsDefault
{
    var $_pagination  = null;
    var $_total       = null;


    /**
    * Builds the query to be used by the book model
    * @return   object  Query object
    *
    *
    */
    protected function _buildQuery()
    {
      $db = JFactory::getDBO();
      $query = $db->getQuery(TRUE);

      $query->select('a.ACTION_ACTIV_REF,a.DESCRIPTION,a.START_DATE,a.DUE_DATE,a.STRUCTURE_CODE,a.RESPONSIBLE_NAME,a.DOMAIN_CODE,a.DIMENSION_CODE');
      $query->from('#__syspat_actions as a');

  //    JFactory::getApplication()->enqueueMessage($query);

      return $query;
    }
protected function _buildWhere(&$query)
  {

    return $query;
  }

}