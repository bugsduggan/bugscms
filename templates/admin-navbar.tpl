<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="index.php">{#site_name#}&nbsp;Admin</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-left">
					{if $page == 'home'}<li class="active">{else}<li>{/if}<a href="index.php">Admin</a></li>
					{if $page == 'pages'}<li class="active">{else}<li>{/if}<a href="index.php?page=pages">Pages</a></li>
					{if $page == 'events'}<li class="active">{else}<li>{/if}<a href="index.php?page=events">Events</a></li>
        </ul>
				<ul class="nav pull-right">
					<li><a href="../index.php">Home</a></li>
					<li><a href="index.php?action=logout">Logout</a></li>
				</ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
