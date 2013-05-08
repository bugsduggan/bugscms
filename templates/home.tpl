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
    <p><a href="index.php?page=article&id={$news_data.top.id}" class="btn btn-primary btn-large">More</a></p>
  </div>

  <!-- Example row of columns -->
  <div class="row">
    <div class="span4">
      <h2>{$news_data.left.title}</h2>
      {$news_data.left.body|truncate:200}
      <p><a class="btn" href="index.php?page=article&id={$news_data.left.id}">More</a></p>
    </div>
    <div class="span4">
      <h2>{$news_data.center.title}</h2>
      {$news_data.center.body|truncate:200}
      <p><a class="btn" href="index.php?page=article&id={$news_data.center.id}">More</a></p>
    </div>
    <div class="span4">
      <h2>{$news_data.right.title}</h2>
      {$news_data.right.body|truncate:200}
      <p><a class="btn" href="index.php?page=article&id={$news_data.right.id}">More</a></p>
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
