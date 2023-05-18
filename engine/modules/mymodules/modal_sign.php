<?php
	/*
	=====================================================
	Автор: Савтаев Бауыржан
	Версия: 1.0
	=====================================================
	Назначение: Вывод модального окна для регистрации
	=====================================================
	*/
	if(!defined("DATALIFEENGINE")) {
		die("Hacking attempt!");
	}
	if(!$is_logged) {
		echo <<<HTML

			<div class="ms_form_block_main" style="visibility: hidden">
				<div class="ms_overlay">
					<div class="ms_form_block">
						<div class="ms_form_block_body">

							<button class="ms_form_close fa fa-close"></button>
							<div class="ms_form_block_title">Регистрация</div>
							<div class="ms_form_block_description">Пожалуйста, введите данные для создания своей учетной записи на нашем сайте.</div>
							<div class="ms_form_block_body_form">
								<input type="text" placeholder="Логин" name="ms_form_input_login" value="" id="ms_form_input_login">
								<input type="email" placeholder="Email" name="ms_form_input_email" value="" id="ms_form_input_email">
								<input type="password" placeholder="Пароль" name="ms_form_input_password" value="" id="ms_form_input_password">
								<div class="ms_form_checkbox_main">
									<input type="checkbox" name="ms_form_checkbox" value="" id="ms_form_checkbox" checked>
									<label for="ms_form_checkbox"><span></span>Авторизация по завершению</label>
								</div>
								<div class="ms_politic">Нажимая кнопку «Зарегистрироваться», Вы безоговорочно соглашаетесь с <a href="/rules.html" target="_blank" title="Правила сайта">правилами сайта</a>.</div>
								<div id="ms_result"></div>
							</div>
							<button id="ms_form_sing_up">Зарегистрироваться</button>
							<button id="ms_form_login">Войти</button>
							<div class="ms_wait"></div>
						</div>
					</div>
				</div>	
			</div>
			<div id="login_pane">
                <form method="post">
                    <div class="login_form">
                        <div class="ms_form_block_title">Войти</div>
                        <input placeholder="Логин" type="text" name="login_name" id="login_name">
                        <input placeholder="Пароль" type="password" name="login_password" id="login_password">
                        <button class="btn" onclick="submit();" type="submit" title="Войти">
                            Войти
                        </button>
                    </div>
                    <input name="login" type="hidden" id="login" value="submit">
                    <button class="btn" id="register-toggle">Регистрация</button>
                </form>
            </div>
			
			<style>
                #login_pane{
                    background-color: rgba(0,0,0,0.5);
                    position: fixed;
                    left: 0;
                    top: 0;
                    width: 100vw;
                    height: 100vh;
                    z-index: 10;
                    visibility: hidden;
                    display: flex;
                    align-items: center;
                }
                #login_pane.visible_login_form{
                    visibility: visible;
                }
                #login_pane form{
                    background-color: white;
                    width: 320px;
                    height: 80vh;
                    margin: 0 auto;
                    padding: 20px;
                }
                #login_pane form a{
                    color: black;
                }
                #login_pane form input{
                    width: 100%;
                    height: 38px;
                    border: 1px solid #ccc;
                    padding: 0 10px;
                    font-size: 14px;
                    background: #fff;
                    display: block;
                    line-height: normal;
                    color: #000;
                    margin: 15px 0;
                    box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, .05);
                    box-sizing: border-box;
                }
                #login_pane form button{
                    width: 100%;
                    display: block;
                    margin: 10px 0;
                    text-align: center;
                    background: #00ff84ff;
                    color: #fff;
                    text-decoration: none;
                    text-transform: uppercase;
                    height: 50px;
                    line-height: 50px;
                    text-shadow: 0 -1px 0 #01d56e;
                    font-weight: 700;
                    border: none;
                    cursor: pointer;
                }
                .box.berrors{
                    background-color: rgba(255,0,0,0.33);
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    box-sizing: border-box;
                    margin: 200px 100px;
                    height: 100px;
                    display: flex;
                    place-items: center;
                    z-index: 11;
                }
            </style>
            <script>
	const loginPaneForm = document.querySelector('#login_pane form')
	loginPaneForm.addEventListener('click', (e) => e.stopPropagation())
	loginPaneForm.addEventListener('submit', (e) => {
		loginPaneForm.parentElement.click()
	})

</script>
			<link rel="stylesheet" type="text/css" href="/engine/skins/modal_sign/css/index.css" />
			<script src="/engine/skins/modal_sign/js/index.js"></script>

HTML;
	}
?>