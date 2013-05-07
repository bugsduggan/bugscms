{extends "master.tpl"}

{block name=content}
<div class="page-header">
	<h1>Install BugsCMS</h1>
</div>

<div class="row">
<div class="column span8">
<form class="form-horizontal" method="post" action="{$page.form_action}">

	<input type="hidden" name="aid" value="{$page.article.aid}">

	<div class="control-group">
		<label class="control-label" for="title">Title</label>
		<div class="controls">
			<input class="span8" type="text" id="title" name="title" value="{$page.article.title|default : 'Title'}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="subtitle">Subtitle</label>
		<div class="controls">
			<input class="span8" type="text" id="subtitle" name="subtitle" placeholder="Subtitle" value="{$page.article.subtitle|default : ''}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="body">Body</label>
		<div class="controls">
			<textarea class="span8" rows="16" id="body" name="body">{$page.article.body|default : #default_article_body#}</textarea>
		</div>
	</div>

	<div class="form-controls pull-right">
		<button type="reset" class="btn">Clear</button>
		<button type="submit" class="btn btn-primary">{$page.form_verb|capitalize}</button>
	</div>

</form>
</div>
<div class="column span3"></div>
</div>
{/block}

{block name=general_debug}
<p class="muted">$aid = '{$page.article.aid}'</p>
<p class="muted">$author_id '{$page.user.uid}'</p>
{/block}
