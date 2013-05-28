{extends "master.tpl"}

{*
	admin.tpl
*}

{block name=centerpanel}
<p class="pull-right"><a href="index.php?page=edit_profile">Edit profile</a></p>
<p class="lead">{$user->get_username()|capitalize}'s profile</p>
<p>Email: <a href="mailto:{$user->get_email()}">{$user->get_email()}</a></p>

<hr>
<p class="pull-right"><a href="index.php?page=articles">Edit pages</a></p>
<p class="lead">Page stats:</p>
<table class="table">
	<tr><th>Published pages:</th><td>{$published}</td></tr>
	<tr><th>Hidden pages:</th><td>{$unpublished}</td></tr>
	<tr><th>Total:</th><td>{$total}</td></tr>
</table>

<hr>
<p class="pull-right"><a href="index.php?page=events_dash">Edit events</a></p>
<p class="lead">Event stats:</p>
<table class="table">
	<tr><th>Upcoming events:</th><td colspan="2">{$upcoming}</td></tr>
	{if isset($next_event)}
	<tr>
		<th>Next event:</th><td colspan="2">{$next_event->get_location()}</td>
	</tr>
	<tr>
		<th></th><td>{$next_event->get_date()|date_format:#date_format#}</td>
		<td>{$next_event->get_date()|date_format:#time_format#}</td>
	</tr>
	{/if}
</table>
{/block}
