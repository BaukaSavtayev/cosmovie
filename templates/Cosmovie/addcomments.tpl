<div class="box">
	<div id="addcomment" class="addcomment">
		<h3>Оставить комментарий</h3>
		<div class="box_in">
			<ul class="ui-form">
			[not-logged]
				<li class="form-group combo">
					<div class="combo_field"><input placeholder="Ваше имя" type="text" name="name" id="name" class="wide" required></div>
					<div class="combo_field"><input placeholder="Ваш e-mail" type="email" name="mail" id="mail" class="wide"></div>
				</li>
			[/not-logged]
				<li id="comment-editor">{editor}</li>
			[recaptcha]
				<li>{recaptcha}</li>
			[/recaptcha]
			[question]
				<li class="form-group">
					<label for="question_answer">{question}</label>
					<input placeholder="Ответ" type="text" name="question_answer" id="question_answer" class="wide" required>
				</li>
			[/question]
			</ul>
			<div class="form_submit">
			[sec_code]
				<div class="c-captcha">
					{sec_code}
					<input placeholder="Повторите код" title="Введите код указанный на картинке" type="text" name="sec_code" id="sec_code" required>
				</div>
			[/sec_code]
				<button class="btn btn-big" type="submit" name="submit" title="Отправить комментарий"><b>Отправить комментарий</b></button>
			</div>
		</div>
	</div>
</div>
<style>
	#section_comments{
		background-color: rgba(255,255,255,0.30);
		margin-bottom: 50px;
	}
	#section_comments form{
	}
	#section_comments form input,
	#section_comments form textarea,
	#section_comments form button[type="submit" ]{
		width: 100%;
		padding: 10px;
		margin: 10px 0;
		box-sizing: border-box;
		border: none;
		outline: none;
		border: 1px solid transparent;
		background-color: rgba(0,0,0,0.44);
		color: white;
	}
	#section_comments form button[type="submit" ]{
		cursor: pointer;
	}
	#section_comments form button[type="submit" ]:hover{
		background-color: rgba(0,0,0,0.67);
	}
	#section_comments form input::placeholder{
		color: white;
	}
	#comments form input:focus{
		border: 1px solid black
	}
</style>
