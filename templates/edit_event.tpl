{extends "master.tpl"}

{block name=centerpanel}
<form class="form-horizontal" method="post" action="index.php?action=update_event">

	<input type="hidden" name="id" value="{$event->get_id()}">
	<input type="hidden" name="status" value="{$event->get_status()}">

	<div class="control-group">
		<label class="control-label" for="location">Location</label>
		<div class="controls">
			<input type="text" id="location" name="location" value="{$event->get_location()}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="date">Date</label>
		<div class="controls">
			<input type="text" id="date" name="date" value="{$event->get_date()}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="comment">Comment</label>
		<div class="controls">
			<input type="text" id="comment" name="comment" value="{$event->get_comment()}">
		</div>
	</div>

	<div class="form-controls">
		<button type="submit" class="btn btn-primary">Save</button>
		<a class="btn" href="index.php?page=events_dash">Cancel</a>
	</div>

</form>
{/block}
