<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class SyspatHelpersView
{
	static function load($viewName, $layoutName='default', $viewFormat='html', $vars=null)
	{
		// Get the application
		$app = JFactory::getApplication();

		$app->input->set('view', $viewName);

        // Register the layout paths for the view
	    $paths = new SplPriorityQueue;
	    $paths->insert(JPATH_COMPONENT . '/views/' . strtolower($viewName) . '/tmpl', 'normal');
	 
	    $viewClass  = 'SyspatViews' . ucfirst($viewName) . ucfirst($viewFormat);
	    $modelClass = 'SyspatModels' . ucfirst($viewName);

	    if (false === class_exists($modelClass))
	    {
	      $modelClass = 'SyspatModelsDefault';
	    }

	    $view = new $viewClass(new $modelClass, $paths);

	    $view->setLayout($layoutName);
	    
		if(isset($vars)) 
		{
			foreach($vars as $varName => $var) 
			{
				$view->$varName = $var;
			}
		}

		return $view;
	}

	static function getHtml($view, $layout, $item, $data)
	{
		$objectView = SyspatHelpersView::load($view, $layout, 'phtml');
  		$objectView->$item = $data;

  		ob_start();
  		echo $objectView->render();
  		$html = ob_get_contents();
  		ob_clean();

  		return $html;
	}
}
