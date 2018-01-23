<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class SyspatModelsStatistics extends JModelBase
{
 
 public function getStats()
 {
    $db = JFactory::getDbo();

    $stats = array();
	//Retrieve Total Comités
    $query = $db->getQuery(true);
    $query->select('COUNT(*)')
          ->from('#__crfpge_comite')
          ->where('state_code = 1');
    $db->setQuery($query);
    
    $stats['total_comites'] = $db->loadResult();
    //Retrieve Total Actions
    $query = $db->getQuery(true);
    $query->select('COUNT(*)')
          ->from('#__crfpge_action')
          ->where('state_code = 1');
    $db->setQuery($query);
    $stats['total_actions'] = $db->loadResult();

    //Retrieve Total Activités
    $query = $db->getQuery(true);
    $query->select('COUNT(*)')
          ->from('#__crfpge_activite')
          ->where('state_code = 1');
    $db->setQuery($query);
    $stats['total_activites'] = $db->loadResult();
	
	//Retrieve Total Documents
    $query = $db->getQuery(true);
    $query->select('COUNT(*)')
          ->from('#__crfpge_institution');
    $db->setQuery($query);
    $stats['total_institutions'] = $db->loadResult();
	
    //Retrieve Total Responsables
    $query = $db->getQuery(true);
    $query->select('COUNT(*)')
          ->from('#__crfpge_membre');
    $db->setQuery($query);
    $stats['total_membres'] = $db->loadResult();
	
	//Retrieve Total Documents
    $query = $db->getQuery(true);
    $query->select('COUNT(*)')
          ->from('#__crfpge_document');
    $db->setQuery($query);
    $stats['total_documents'] = $db->loadResult();
	

    return $stats;
 }

}