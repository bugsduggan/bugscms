{extends "master.tpl"}

{*
	admin.tpl
*}

{block name=centerpanel}
<p class="lead">Logged in as: {$user->get_username()}</p>
<p><a href="index.php?page=edit_profile">Change password</a></p>
{/block}
