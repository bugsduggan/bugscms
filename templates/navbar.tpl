{if isset($page.navbar)}
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="{$page.navbar.default.link}">{$page.navbar.default.text}</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-left">
					{foreach $page.navbar.item as $nav}
						{if $nav.active == 'true'}<li class="active">
						{else}<li>
						{/if}
						<a href="{$nav.link}">{$nav.text|capitalize}</a></li>
					{/foreach}
        </ul>
				<ul class="nav pull-right">
				{if $show_admin_buttons}
					<li><a href="{$page.navbar.admin_link}">Admin</a></li>
					<li><a href="{$page.navbar.logout_link}">Logout</a></li>
				{else}
				<form class="navbar-form" method="post" action="{$page.navbar.login_link}">
					<input type="text" class="span2 search-query" id="username" name="username" placeholder="Username">
					<input type="password" class="span2 search-query" id="password" name="password" placeholder="Password">
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
				{/if}
				</ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
{/if}
