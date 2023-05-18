<div id="login_pane">
	<a href="{profile-link}">
		{login}
	</a>
	<div id="login-info">
		[admin-link]
		<div class="login_pane__info">
			<div class="login_pane__admin"><a href="{admin-link}" target="_blank">Админпанель</a></div>
		</div>
		[/admin-link]
		<a class="btn" href="{pm-link}">Сообщения <span class="right grey"><b>{new-pm}</b> из {all-pm}</span></a>
		<a class="btn" href="{favorites-link}">Закладки <span class="right grey"><b>{favorite-count}</b></span></a>
		<a class="btn" href="{newposts-link}">Непрочитанные новости</a>
		<a class="btn" href="{logout-link}">Выход</a>
		<a class="btn" href="{addnews-link}"><span>+</span>Добавить новость</a>
	</div>
</div>
<style>
	#login_pane{
		background-color: black;
	}
	#login_pane>a{
		height: 100%;
		display: block;
		line-height: 50px;
	}
	#login-info{
		transition: height 0.2s;
		height: 0;
		box-sizing: border-box;
		overflow: hidden;
		background-color: black;
	}
	#login-info .btn{
		display: block;
	}
	#login-info .btn:hover{
		background-color: white;
	}
	#login-info>*{
		padding: 10px;
	}
	#login_pane:hover #login-info{
		transition: height 0.2s;
		height: 230px;
	}
</style>