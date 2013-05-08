{extends "master.tpl"}

{block name=css}
{/block}

{block name=body}
<div class="container">

	{if isset($news_data)}
  <!-- Main hero unit for a primary marketing message or call to action -->
  <div class="hero-unit">
    <h1>{$news_data.top.title}</h1>
		{$news_data.top.body|truncate:200}
    <p><a href="{$news_data.top.link}" class="btn btn-primary btn-large">{$news_data.top.link_text}</a></p>
  </div>

  <!-- Example row of columns -->
  <div class="row">
    <div class="span4">
      <h2>{$news_data.left.title}</h2>
      {$news_data.left.body|truncate:200}
      <p><a class="btn" href="{$news_data.left.link}">{$news_data.left.link_text}</a></p>
    </div>
    <div class="span4">
      <h2>{$news_data.center.title}</h2>
      {$news_data.center.body|truncate:200}
      <p><a class="btn" href="{$news_data.center.link}">{$news_data.center.link_text}</a></p>
    </div>
    <div class="span4">
      <h2>{$news_data.right.title}</h2>
      {$news_data.right.body|truncate:200}
      <p><a class="btn" href="{$news_data.right.link}">{$news_data.right.link_text}</a></p>
    </div>
  </div>
	{else}
	<p class="lead">No news to display</p>
	{/if}

  <hr>


</div> <!-- /container -->
{/block}

{block name=javascript}
{/block}
