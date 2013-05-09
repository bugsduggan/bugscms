{extends "master.tpl"}

{block name=body}
<h1>{$user->get_username()}</h1>
<p>Id = {$user->get_id()}</p>
<p>Username = {$user->get_username()}</p>
<p>Password sha1 = {$user->get_password()}</p>
<p>Email = {$user->get_email()}</p>
<p>Status = {if $user->is_admin()}Admin{else}User{/if}</p>
{/block}
