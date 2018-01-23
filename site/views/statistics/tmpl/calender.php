<?php
defined('_JEXEC') or die();

JHtml::_('jquery.framework', false);
JHtml::_('stylesheet', 'com_syspat/fullcalendar.min.css', false, true, false);
JHtml::_('stylesheet', 'com_syspat/fullcalendar.print.min.css','print', false, true, false);
JHtml::_('script', 'com_syspat/moment.min.js', false, true);
JHtml::_('script', 'com_syspat/fullcalendar.min.js', false, true);
JHtml::_('script', 'com_syspat/locale-all.js', false, true);
?>
<h3>Calendrier</h3>
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