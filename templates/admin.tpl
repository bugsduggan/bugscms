{extends "master.tpl"}

{*
	admin.tpl
*}

{block name=centerpanel}
<p class="pull-right"><a href="index.php?page=edit_profile">Edit profile</a></p>
<p class="lead">{$user->get_username()|capitalize}'s profile</p>
<p>Email: <a href="mailto:{$user->get_email()}">{$user->get_email()}</a></p>
<hr>
<p class="pull-right"><a href="index.php?page=articles">Edit pages</a></p>
<p class="lead">Page stats:</p>
<table class="table">
	<tr><th>Published pages:</th><td>{$published}</td></tr>
	<tr><th>Hidden pages:</th><td>{$unpublished}</td></tr>
	<tr><th>Total:</th><td>{$total}</td></tr>
</table>
{/block}
