<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="HandheldFriendly" content="true">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="user-scalable=0, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	{*	<link href="{THEME}/css/engine.css" type="text/css" rel="stylesheet">	*}
	<link rel="stylesheet" href="{THEME}/css/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;1,200;1,300;1,400;1,600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{THEME}/css/styles.css">
	[available=showfull]<link rel="stylesheet" href="{THEME}/css/fullpagestyle.css">[/available]
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#000">
	{headers}
	[category=11]
	<style>
		body main .swiper-cat.collections{
			grid-template-columns: repeat(auto-fill, 290px)!important;
			grid-template-rows: 50px repeat(auto-fill, 200px)!important;

		}
		@media only screen and (max-width: 720px) {
			html body main .collections.swiper{
				grid-template-columns: repeat(auto-fill, 260px)!important;
				grid-template-rows: 50px repeat(auto-fill, 170px)!important;
			}
		}
		body main h2{
			margin-top: 40px;
		}
		.collectimg{
			height: 45vh;
		}
		body main h2 a{
			font-size:22px;
			border-bottom: 4px dotted #00ff84ff;
			padding-bottom: 3px;
		}
		main>h2+img{
			width: 100%;
			height: 500px;
			object-fit: cover;
		}
		.imdbrate, .kprate{
			font-size: 17px;
			font-weight: bold;
			color: gold;
		}
		.kprate{
			color: darkorange;
		}
	</style>
	[/category]
</head>
<body>
{AJAX}


<header>
	<button id="burgerbtn">
		&#9776;
	</button>
	<div id="logo">
		<a href="/">
			Cosmovie
		</a>
	</div>
	<nav>
		<ul>
			<li class="hassubmenu">
				<div class="submenu-header"><span>Жанр</span> <span class="fa fa-chevron-down"></span></div>
				<div class="submenu">
					<ul>
						{include file="modules/mymodules/genres.tpl"}
					</ul>
				</div>
			</li>
			{** <li class="hassubmenu">
                <div class="submenu-header"><span>Страны</span> <span class="fa fa-chevron-down"></span></div>
                <div class="submenu">
                    <ul>
                        {include file="country.tpl"}
                    </ul>
                </div>
            </li>
            **}
			<li>
			<li>
				<a href="/films">Фильмы</a>
			</li>
			<li>
				<a href="/series">Сериалы</a>
			</li>
			<li>
				<a href="/multfilms">Мультфильмы</a>
			</li>
			<li>
				<a href="/cartoons">Мультсериалы</a>
			</li>
		</ul>
	</nav>
	<div id="navrigthsect">
{*		<div>{login}</div>*}
		<div id="search">
			<form id="q_search" method="post" >
				<input type="text" placeholder="Поиск" id="story" name="story">
				<input type="hidden" name="do" value="search">
				<input type="hidden" name="subaction" value="search">
			</form>
			<button type="submit" class="fa fa-search"></button>
		</div>
		[group=5]
		<div id="log">
			<button id="ms_link" title="Авторизация на сайте" class="fa fa-sign-in"></button>
		</div>
		[/group]
		[not-group=5]
		{login}
		[/not-group]
	</div>
</header>
{*{include file="modules/header.tpl"}*}
[available=main]{include file="modules/mymodules/bigslider.tpl"}[/available]
<main>
	[available=cat|xfsearch|catalog|alltags|tags|lastnews|allnews|search]
	{content}
	<h2>
		[not-available=search]
		Смотреть <span style="text-transform: lowercase;">{category-title}</span>
		{include file="engine/modules/mymodules/xftitle.php"}
		[/not-available]
		[available=search]
		Результаты поиска:
		[/available]
	</h2>
	<div class="swiper swiper-cat [category=11]collections[/category]">
		[/available]
		[available=main]
		{include file="modules/mymodules/minislider.tpl"}
		{include file="modules/mymodules/subfooter.tpl"}
		[/available]
		{info}
		[not-available=main]
		{content}
		[/not-available]
		[available=cat|xfsearch|catalog|alltags|tags|lastnews|allnews|search]
	</div>
	[/available]
</main>



<button id="page_up" class="fa fa-arrow-circle-up"></button>

{include file="modules/footer.tpl"}
{include file="engine/modules/mymodules/modal_sign.php"}
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="{THEME}/js/main.js"></script>
</body>
</html>