{config_load $smarty.const.CONFIG section=global scope=local}

{*
	navbar.tpl

	Creates the navbar along the top of the screen.
	Expects $page to be set.
*}

<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="index.php?page=home">{#site_name#}</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-left">
          {if $page == 'home'}<li class="active">{else}<li>{/if}
						<a href="index.php?page=home"><i class="icon-home icon-white"></i> Home</a></li>
					{if $page == 'about'}<li class="active">{else}<li>{/if}
						<a href="index.php?page=about">About</a></li>
					{if $page == 'events'}<li class="active">{else}<li>{/if}
						<a href="index.php?page=events">Events</a></li>
        </ul>
				<ul class="nav pull-right">
					{if $logged_in}
					<!--<li><a>Logged in as {$user->get_username()}</a></li>-->
					<li><a href="index.php?action=logout">Logout</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog icon-white"></i></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?page=admin"><i class="icon-user"></i> Profile</a></li>
							<li><a href="index.php?page=articles"><i class="icon-book"></i> Pages</a></li>
							<li><a href="index.php?page=events_dash"><i class="icon-bullhorn"></i> Events</a></li>
						</ul>
					</li>
					{/if}
					{if !$logged_in && #show_login#}
					<li><a href="index.php?page=register">Register</a></li>
					<li><a href="index.php?page=login">Login</a></li>
					{/if}
				</ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
