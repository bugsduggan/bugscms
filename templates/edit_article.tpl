{extends "master.tpl"}

{*
	edit_article.tpl
*}

{block name=body}
<div class="container">
	<div class="page-header">
		<h1>{$page|capitalize}</h1>
	</div>

	<form class="form-horizontal" method="post" action="index.php?action=update_page">
	
		<input type="hidden" name="id" value="{$article->get_id()}">
		<input type="hidden" name="status" value="{$article->get_status()}">

		<div class="control-group">
			<label class="control-label" for="title">Title</label>
			<div class="controls">
				<input class="span8" type="text" id="title" name="title" value="{$article->get_title()}">
			</div>
		</div>
	
		<div class="control-group">
			<label class="control-label" for="body">Body</label>
			<div class="controls">
				<textarea class="span8" id="body" name="body" rows="20">{$article->get_body()}</textarea>
			</div>
		</div>

		<div class="form-controls">
			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn" href="index.php?page=articles">Cancel</a>
		</div>

	</form>
</div>
<div id="push"></div>
{/block}

{block name=headscript}
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
		theme: "modern",
		width: 768,
		plugins: 'link image',
		content_css: "css/tinymce.css"
});
</script>
{/block}
