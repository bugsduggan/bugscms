{extends "admin-master.tpl"}

{block name=head}
{/block}

{block name=body}
<div class="container">

	<div class="page-header">
		<h1>Edit event</h1>
	</div>

	<form class="form-horizontal" method="post" action="index.php?action=save_event">

		{if isset($gig)}
		<input type="hidden" id="id" name="id" value="{$gig.id}">
		{/if}

		<div class="control-group">
			<label class="control-label" for="name">Name</label>
			<div class="controls">
				{if isset($gig)}
				<input type="text" id="name" name="name" value="{$gig.name}">
				{else}
				<input type="text" id="name" name="name" placeholder="Name">
				{/if}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="location">Location</label>
			<div class="controls">
				{if isset($gig)}
				<input type="text" id="location" name="location" value="{$gig.location}">
				{else}
				<input type="text" id="location" name="location" placeholder="Location">
				{/if}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="date">Date</label>
			<div class="controls">
				{if isset($gig)}
				<input type="text" id="date" name="date" value="{$gig.date}">
				{else}
				<input type="text" id="date" name="date" placeholder="Date">
				{/if}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="map_link">Map link</label>
			<div class="controls">
				{if isset($gig)}
				<input type="text" id="map_link" name="map_link" value="{$gig.map_link}">
				{else}
				<input type="text" id="map_link" name="map_link" placeholder="Map link">
				{/if}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="info_link">Info link</label>
			<div class="controls">
				{if isset($gig)}
				<input type="text" id="info_link" name="info_link" value="{$gig.info_link}">
				{else}
				<input type="text" id="info_link" name="info_link" placeholder="Info link">
				{/if}
			</div>
		</div>

		<div class="form-controls">
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn" href="index.php?page=gigs">Back</a>
		</div>

	</form>

</div>
{/block}

{block name=javascript}
{/block}
