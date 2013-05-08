{extends "master.tpl"}

{block name=css}
{/block}

{block name=body}
<div class="container">

  <!-- Main hero unit for a primary marketing message or call to action -->
	{if isset($about)}
  <div class="hero-unit">

    <h1>{$about.title}</h1>
		{$about.body|truncate:100}
		<p><a href="index.php?page=about" class="btn btn-primary btn-large">Learn more</a></p>

  </div>
	{else}
	<p class="lead">No about data</p>
	{/if}

	{if isset($news_data)}
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
