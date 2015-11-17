<?php
$base_url = ewUtils::get_base_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php slot('__title','Wisconsin Tourism Attractions and Events | Explore Wisconsin') ?></title>
    <meta name="description" content="<?php slot('__description','Wisconsin Tourist Attractions Restaurants Shopping Bars Places to Stay  Travel Explore The Badger States Best Places to Eat, Shop, Stay, or Play.  Trips Adventures and Fun') ?>" />
    <meta name="keywords" content="<?php slot('__keywords','Wisconsin, Tourism, Restaurants, Bars, Bed, Breakfast, Hotel, Motel, Travel, Map, Play, Information') ?>" />
    <meta name="google-site-verification" content="cgP5oLAorZpvsazu6ztHQa9pb52pr4BBNefXZUXxnyE" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" />
	<link href="/css/style.less" rel="stylesheet" type="text/less" />
</head>
<body>

<header>
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand logo" href="/">Explore Wisconsin</a>
			</div>
			<div class="navbar-collapse collapse">
				<form class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Directory Search...">
					</div>
					<button type="submit" class="btn btn-primary"><em class="fa fa-search"></em></button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Spotlight Page</a></li>
							<li><a href="#">Explore Page</a></li>
							<li><a href="#">Custom Website Design</a></li>
							<li><a href="#">Optimization</a></li>
						</ul>
					</li>
					<li><a href="#">Resources</a></li>
					<li><a href="http://blog.explorewisconsin.com">Blog</a></li>
					<li><a href="#">Support</a></li>
					<li><a href="/contact">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>