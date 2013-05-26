{extends "master.tpl"}

{*
	home.tpl
*}

{block name=title}
<div class="page-header">
	<h1>{$article.title|capitalize}</h1>
</div>
{/block}

{block name=centerpanel}
{$article.body}
{/block}
