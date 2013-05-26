{extends "master.tpl"}

{*
	admin.tpl
*}

{block name=centerpanel}
<form class="form-horizontal" method="post" action="index.php?action=update_page">
	
	<input type="hidden" name="id" value="{$article->get_id()}">

	<div class="control-group">
		<label class="control-label" for="title">Title</label>
		<div class="controls">
			<input class="span5" type="text" id="title" name="title" value="{$article->get_title()}">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="body">Body</label>
		<div class="controls">
			<textarea class="span5" id="body" name="body" rows="20">{$article->get_body()}</textarea>
		</div>
	</div>

	<div class="form-controls">
		<button type="submit" class="btn btn-primary">Save</button>
	</div>

</form>
{/block}
