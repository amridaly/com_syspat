<?php
defined('_JEXEC') or die();

JHtml::_('jquery.framework', false);
JHtml::_('stylesheet', 'com_syspat/fullcalendar.min.css', false, true, false);
JHtml::_('stylesheet', 'com_syspat/fullcalendar.print.min.css','print', false, true, false);
JHtml::_('script', 'com_syspat/moment.min.js', false, true);
JHtml::_('script', 'com_syspat/fullcalendar.min.js', false, true);
JHtml::_('script', 'com_syspat/locale-all.js', false, true);
?>
<h3>Calendrier du PAT</h3>
<p>Les autorités haïtiennes se sont engagées dans la définition d’une stratégie globale et cohérente de réformes des systèmes de gestion des finances publiques. 
    En effet, le Gouvernement a procédé en mai 2014 à l’adoption de la « Stratégie de Réformes des Finances Publiques (SRFP) » et de son Plan d’Action triennal (PAT) 2014-2016. 
    Le PAT 2014-2016 permet d’opérationnaliser concrètement les actions et les résultats attendus, et définit un séquençage pour chacun des processus de réforme.
</p>
</br>
<div id='calendar'></div>
<script type="text/javascript">
var json_events;
jQuery(document).ready(function() {
        jQuery.ajax({
            url: 'index.php?option=com_syspat&controller=calendar&format=json',
            type: 'POST',
            async: false,
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',			
            success: function(response){ 
                json_events = response;
		jQuery('#calendar').fullCalendar({
                    buttonIcons: false,
                    theme: false,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    height: 550,
                    locale: 'fr',
                    eventLimit: true,
                    //defaultView: 'agendaDay',
                    editable: false,
                    events: json_events
                });
            }
	});			
 });			
</script>