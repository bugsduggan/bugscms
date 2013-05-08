{extends "master.tpl"}

{block name=head}
{/block}

{block name=body}
<div class="container">
	<div class="page-header">
		<h1>Events</h1>
	</div>

	{if isset($gig_data)}
	<table class="table table-bordered table-striped">
		<tr><th>Location</th><th>Date</th><th>Time</th><th>Map</th><th>Info</th></tr>
		{foreach $gig_data as $gig}
			<tr>
			<td>{$gig.location}</td>
			<td>{$gig.date|date_format:#date_format#}</td>
			<td>{$gig.date|date_format:#time_format#}</td>
			<td>{if $gig.map_link != ''}<a href="{$gig.map_link}">Map</a>{else}&nbsp;{/if}</td>
			<td>{if $gig.info_link != ''}<a href="{$gig.info_link}">Buy</a>{else}&nbsp;{/if}</td>
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
