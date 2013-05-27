{extends "master.tpl"}

{*
	edit_article.tpl
*}

{block name=centerpanel}
<form class="form-horizontal" method="post" action="index.php?action=update_page">
	
	<input type="hidden" name="id" value="{$article->get_id()}">
	<input type="hidden" name="status" value="{$article->get_status()}">

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

{block name=headscript}
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
		theme: "modern",
		width: 468,
		plugins: 'link',
		content_css: "css/tinymce.css"
});
</script>
{/block}
