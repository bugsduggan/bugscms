{extends "master.tpl"}

{block name=css}
{/block}

{block name=body}
<div class="container">

  <!-- Main hero unit for a primary marketing message or call to action -->
  <div class="hero-unit">
    <h1>{$top_article.headline}</h1>
		<p>{$top_article.body}</h1>
    <p><a href="{$top_article.link}" class="btn btn-primary btn-large">{$top_article.link_text}</a></p>
  </div>

  <!-- Example row of columns -->
  <div class="row">
    <div class="span4">
      <h2>{$story1.headline}</h2>
      <p>{$story1.body}</p>
      <p><a class="btn" href="{$story1.link}">{$story1.link_text}</a></p>
    </div>
    <div class="span4">
      <h2>{$story2.headline}</h2>
      <p>{$story2.body}</p>
      <p><a class="btn" href="{$story2.link}">{$story2.link_text}</a></p>
    </div>
    <div class="span4">
      <h2>{$story2.headline}</h2>
      <p>{$story2.body}</p>
      <p><a class="btn" href="{$story2.link}">{$story2.link_text}</a></p>
    </div>
  </div>

  <hr>


</div> <!-- /container -->
{/block}

{block name=javascript}
{/block}
