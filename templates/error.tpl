{extends "master.tpl"}

{block name=content}
<h1>Oh noes!</h1>
<p class="lead">Looks like something went wrong</p>
<p><a class="btn btn-primary" href="{$page.error.errlink}">{$page.error.errlink_text}</a></p>
{/block}

{block name=general_debug}
<p class="muted">$err_errno = '{$page.error.errno}'</p>
<p class="muted">$err_msg = '{$page.error.errmsg}'</p>
{/block}
