{extends "master.tpl"}

{block name=style}
{/block}

{block name=body}
<div class="container">
	<div class="page-header">
		<h1>Gigs</h1>
	</div>

	{if isset($gig_data)}
	<table class="table table-bordered table-striped">
		<tr><th>Where</th><th>When</th><th>Starts</th><th>Map</th><th>Buy tickets</th></tr>
		{foreach $gig_data as $gig}
			<tr>
			<td>{$gig.location}</td>
			<td>{$gig.date|date_format:#date_format#}</td>
			<td>{$gig.date|date_format:#time_format#}</td>
			<td>{if isset($gig.map_link)}<a href="{$gig.map_link}">Map</a>{else}&nbsp;{/if}</td>
			<td>{if isset($gig.buy_link)}<a href="{$gig.buy_link}">Buy</a>{else}&nbsp;{/if}</td>
			</tr>
		{/foreach}
	</table>
	{else}
	<p class="lead">No gig data to display</p>
	{/if}

</div>
{/block}

{block name=javascript}
{/block}
