{extends "admin-master.tpl"}

{block name=head}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Events</h1>
	</div>

	<div class="row">
		<div class="column span4">
			<p><a class="btn btn-primary" href="index.php?page=event">New event</a></p>
		</div>
		<div class="column span4">
		</div>
		<div class="column span4">
			{if isset($gigs)}
			<p><strong>Events:</strong> {count($gigs)}</p>
			{/if}
		</div>
	</div>

	<hr>

	{if isset($gigs)}
	<table class="table table-striped table-bordered">
		<tr><th>ID</th><th>Location</th><th>Date</th><th>Time</th><th>Map</th><th>Buy</th><th>Edit</td></tr>
		{foreach $gigs as $gig}
		<tr>
			<td>{$gig.id}</td>
			<td>{$gig.location}</td>
			<td>{$gig.date|date_format:#date_format#}</td>
			<td>{$gig.date|date_format:#time_format#}</td>
			<td>
			{if $gig.map_link != ''}<a href="{$gig.map_link}">Map</a>{/if}
			</td><td>
			{if $gig.info_link != ''}<a href="{$gig.info_link}">Info</a>{/if}
			</td>
			<td><a href="index.php?page=event&id={$gig.id}">Edit</a></td>
		</tr>
		{/foreach}
	</table>
	{else}
	<p class="lead">No events to display</p>
	{/if}

</div>
{/block}

{block name=javascript}
{/block}
