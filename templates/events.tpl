{extends "master.tpl"}

{*
	events.tpl
*}


{block name=rightpanel}
{if $logged_in}
<p><a href="index.php?page=events_dash">Add/edit events</a></p>
{/if}
{/block}

{block name=centerpanel}
{if count($events) > 0}
{assign var=default_comment value="<p class=\"lead\">Next show:</p><p>{$events[0]->get_location()}<p><p>{$events[0]->get_date()|date_format:#date_format#}</p>"}
<div class="info">
	<img class="img-polaroid event-map pull-right" src="{$event_map}" alt="Map of events">
	<div id="comment" class="span3">{$default_comment}</div>
</div>
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr onmouseover="mouse_event(this, 'success', '{$event->get_comment()|escape:'quotes'}')" onmouseout="mouse_event(this, '', '')">
<td>{$event->get_location()}</td>
<td>{$event->get_date()|date_format:#date_format#}</td>
<td>{$event->get_date()|date_format:#time_format#}</td>
<td><a href="{$event->get_map_link()}">Map</a></td>
</tr>
{/foreach}
</table>
{else}
<p class="lead">No events</p>
{/if}
{/block}

{block name=style}
.event-map {
	margin-bottom: 40px;
}
.info {
	margin-bottom: 20px;
}
@media (max-width:797px) {
	.event-map {
		margin-left: 20px;
	}
}
{/block}

{block name=headscript}
<script type="text/javascript">
function mouse_event(obj, newClass, comment) {
	obj.className = newClass;
	if (comment == '') {
		comment = '<p class="lead">Next show:</p><p>{$events[0]->get_location()}<p><p>{$events[0]->get_date()|date_format:#date_format#}</p>';
	}
	document.getElementById("comment").innerHTML=comment;
}
</script>
{/block}
