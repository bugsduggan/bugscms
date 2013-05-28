{extends "master.tpl"}

{*
	edit_event.tpl
*}

{block name=centerpanel}
<form class="form-horizontal" method="post" action="index.php?action=update_event">

	<input type="hidden" name="id" value="{$event->get_id()}">
	<input type="hidden" name="status" value="{$event->get_status()}">

	<div class="control-group">
		<label class="control-label" for="location">Location</label>
		<div class="controls">
			<input class="span4" type="text" id="location" name="location" value="{$event->get_location()}">
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
			<input class="span4" type="text" id="comment" name="comment" value="{$event->get_comment()}">
		</div>
	</div>

	<div class="form-controls">
		<button type="submit" class="btn btn-primary">Save</button>
		<a class="btn" href="index.php?page=events_dash">Cancel</a>
	</div>

</form>
{/block}

{block name=headscript}
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript">
$(function() {
	$('#date').datetimepicker({
		stepMinute: 15
	});
});
</script>
{/block}

{block name=style}
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
{/block}
