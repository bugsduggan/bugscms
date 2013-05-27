{extends "master.tpl"}

{*
	admin.tpl
*}

{block name=centerpanel}
<p class="pull-right"><a href="index.php?page=edit_profile">Edit profile</a></p>
<p class="lead">Logged in as: {$user->get_username()}</p>
<p>Email: <a href="mailto:{$user->get_email()}">{$user->get_email()}</a></p>
{/block}
