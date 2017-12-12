<?php
defined('_JEXEC') or die;

class EvaluationsController extends JControllerLegacy
{
  public function display($cachable = false, $urlparams = false)
  {
    $document = JFactory::getDocument();
    
    //La vue par défaut est actions la page qui va afficher la liste
    $vName = $this->input->get('view', 'actions');
    $this->input->set('view', $vName);
    
    $safeurlparams = array(
      'id'=>'INT',
    );
    
    parent::display($cachable, $safeurlparams);
    
    return $this;    
  }
} 