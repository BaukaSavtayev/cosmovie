<div id="film">
	<div class="poster">
		<img src="[xfvalue_poster]" alt="">
		<span class="fa fa-bookmark"></span>
		<div class="shareon">
			<a class="facebook"></a>
			<button class="telegram"></button>
			<button class="twitter"></button>
			<button class="vkontakte"></button>
			<button class="whatsapp"></button>
		</div>
	</div>
	<div class="filminfo">
		<h1>{title}</h1>
		<span class="originalname">[xfvalue_origin]</span>
		<div class="otherifo"><span class="key">Режиссёр:</span><span class="value">[xfvalue_director]</span></div>
		<div class="otherifo"><span class="key">Жанр:</span><span class="value genres">{link-category}</span></div>
		<div class="otherifo"><span class="key">Страна:</span><span class="value">[xfvalue_country]</span></div>
		<div class="otherifo"><span class="key">Год:</span><span class="value">[xfvalue_year]</span></div>
		<div class="otherifo"><span class="key">Продолжительность:</span><span class="value">[xfvalue_duration]</span></div>
		<div class="otherifo"><span class="key">Премьера:</span><span class="value">[xfvalue_premiere]</span></div>
		<div class="otherifo"><span class="key">Актёры:</span><span class="value">[xfvalue_actor]</span></div>
		<div class="rate">
			<div class="otherifo imdb">
				<span class="key">
					<span class="hideword">Рейтинг IMDb:</span>
				</span>
				<span class="fa fa-imdb"></span>
				<span class="value">
					[xfvalue_rating-imdb]
				</span>
			</div>
			<div class="otherifo kinopoisk">
				<span class="key">
					<span class="hideword">Рейтинг КП:</span>
				</span>
				<span class="fa-kinopoisk">КП</span>
				<span class="value">
					[xfvalue_rating-kinopoisk]
				</span>
			</div>
		</div>
	</div>
	<p class="description">{short-story}</p>
</div>

<div id="filmrate">
	<span>Как вы оцениваете этот фильм?</span>
	{rating}
</div>

<h2>Смотреть {title} онлайн в высоком качестве</h2>
<div id="player">
	<span class="fa fa-eye"> {views}</span>
	<div id="yohoho" data-kinopoisk="[xfvalue_kp-id]" data-player="hdvb,videocdn,bazon,ustore,collaps,trailer" data-loading="{THEME}/images/player.gif"></div>
	<script src="//yohoho.cc/yo.js"></script>
</div>
[xfgiven_sequels]
{include file="modules/mymodules/sequels.tpl"}
[/xfgiven_sequels]
<div class="h2">Другие фильмы и сериалы
	{*[catlist=9]С„РёР»СЊРјС‹[/catlist]
    [catlist=10]СЃРµСЂРёР°Р»С‹[/catlist]
    [catlist=11]РјСѓР»СЊС‚С„РёР»СЊРјС‹[/catlist]
    [catlist=12]РјСѓР»СЊС‚СЃРµСЂРёР°Р»С‹[/catlist]*}
</div>
<div class="swiper minislider1">
	<div class="swiper-wrapper">
		{custom limit=10 idexclude=[xfvalue_sequels]}
		<div class="swiper-slide last-child">
			<a href=""><span>Смотреть всё &nbsp;</span><span class="fa fa-arrow-right"></span></a>
		</div>
	</div>
</div>
<div class="swipbuttons swipbuttons1">
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
</div>
<section id="section_comments">
	{addcomments}
	{comments}

	<style>
		.genres a:last-child{
			display: none;
		}
		.com_content{
		}
		.comment{
			width: 100%;
			height: 50px;
		}
		ol{
			list-style: none;
			padding: 0;
			margin: 0;
		}
		.comments-tree-list {
		}
		#section_comments .comments-tree-list .comments-tree-item,
		#dle-comments-list .film-comment{
			width: 100%;
			margin: 10px 0;
			border-radius: 10px;
			border: 2px solid black;
			color: white;
			background-color: rgba(0,0,0,0.22);
			overflow: hidden;
			padding: 15px;
			box-sizing: border-box;
		}
		.film-comment .fa-thumbs-up, .film-comment .like{
			color: #00ff61;
			font-size: 20px;
		}
		.film-comment .like{
			margin-right: 10px;
		}
		.film-comment .fa-thumbs-down, .film-comment .dislike{
			color: #ff0066;
			font-size: 20px;
		}
	</style>
</section>
