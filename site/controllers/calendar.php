<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class SyspatControllersCalendar extends SyspatControllersDefault
{
    public function execute()
    {
        $app= JFactory::getApplication();
        $return  = array("success"=>false);

        $view       = $app->input->get('view', 'calendar');
        $layout     = $app->input->get('layout', 'calendar');
   


  	$model = new SyspatModelsCalendar();
	 
	foreach($model->listItems() as $i=>$dataItem):

            $event_array[] = array(
                'id' => $dataItem->ACTION_ACTIV_REF,
                'title' => $dataItem->DESCRIPTION,
                'start' => $dataItem->START_DATE,
                'end' => $dataItem->DUE_DATE,
                'allDay' => false
            );
	
	endforeach;
	
    // Get the document object.
    $document = JFactory::getDocument();
    // Set the MIME type for JSON output.
    $document->setMimeEncoding('application/json');
    // Change the suggested filename.
    JResponse::setHeader('Content-Disposition','attachment;filename="result.json"');
    // Output the JSON data.
    echo json_encode($event_array);
    exit;
	 
  
  }
}