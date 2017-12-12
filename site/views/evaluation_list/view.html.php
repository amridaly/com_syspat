<?php
defined('_JEXEC') or die;

class SyspatViewAction_activ extends JViewLegacy
{
  public function display($tpl = null)
  {
    //Nous récupérons les enregistrement en faisant appel au modèle
    $actions = $this->get('Items');
    $this->actions = &$actions;
    
    parent::display($tpl);
    
  }
}