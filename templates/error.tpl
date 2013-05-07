{extends "master.tpl"}

{block name=page_header}
<h1>Oh noes!</h1>
{/block}

{block name=sub_header}
<p class="lead">Looks like something went wrong</p>
<p><a class="btn btn-primary" href="index.php">Home</a></p>
{/block}

{block name=content}
{/block}

{block name=debug}
<p class="muted">$err_errno = '{$page.error.errno}'</p>
<p class="muted">$err_msg = '{$page.error.msg}'</p>
{/block}
