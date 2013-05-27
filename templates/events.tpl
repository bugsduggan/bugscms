{extends "master.tpl"}

{*
	events.tpl
*}

{block name=centerpanel}
{if count($events) > 0}
<table class="table table-striped table-bordered">
{foreach $events as $event}
<tr>
<td>{$event->get_location()}</td>
<td>{$event->get_date()|date_format:#date_format#} - {$event->get_date()|date_format:#time_format#}</td>
<td>{$event->get_comment()}</td>
</tr>
{/foreach}
</table>
{else}
<p class="lead">No events</p>
{/if}
{/block}
