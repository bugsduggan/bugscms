{extends "master.tpl"}

{*
	users.tpl
*}

{block name=centerpanel}
<table class="table table-striped table-bordered">
<tr></tr>
{foreach $users as $user}
{if $user->is_admin()}
<tr class="success">
{else}
<tr>
{/if}
<td>{$user->get_id()}</td>
<td>{$user->get_username()}</td>
</tr>
{/foreach}
</table>
{/block}
