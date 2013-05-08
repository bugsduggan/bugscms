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
					{if $page == 'home'}<li class="active">{else}<li>{/if}<a href="../index.php">Home</a></li>
        </ul>
				<ul class="nav pull-right">
					{if $page == 'admin'}<li class="active">{else}<li>{/if}<a href="admin/index.php">Admin</a></li>
					<li><a href="index.php?action=logout">Logout</a></li>
				</ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>
