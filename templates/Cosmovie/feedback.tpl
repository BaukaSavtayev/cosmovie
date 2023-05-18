{*include file="modules/contacts.tpl"*}
{*include file="modules/map.tpl"*}
<h1>Обратная связь</h1>

[not-logged]
<input placeholder="Ваше имя" type="text" maxlength="35" name="name" id="name" class="wide" required>
<input placeholder="Ваш E-mail" type="email" maxlength="35" name="email" id="email" class="wide" required>
[/not-logged]
<input placeholder="Тема сообщения" type="text" maxlength="45" name="subject" id="subject" class="wide" required>
<h4>Получатель</h4>
{recipient}
<textarea placeholder="Сообщение" name="message" id="message" rows="8" class="wide" required></textarea>
[recaptcha]
		<li class="form-group">{recaptcha}</li>
[/recaptcha]
[question]
<label for="question_answer">Вопрос: {question}</label>
<input placeholder="Ответ" type="text" name="question_answer" id="question_answer" class="wide" required>
[/question]

[sec_code]
	<div class="c-captcha">
		{code}
		<input placeholder="Повторите код" title="Введите код указанный на картинке" type="text" name="sec_code" id="sec_code" required>
	</div>
[/sec_code]
<button class="btn btn-big" type="submit" name="send_btn"><b>Отправить сообщение</b></button>

<style>
	main input, main select,main textarea,main button{
		min-width: 100%;
		box-sizing: border-box;
		outline: none;
		display: block;
		padding: 10px;
		border: none;
		margin: 10px 0;
	}
	main button{
		background-color: #00ff84ff;
		color: white;
		cursor: pointer;
	}
	main button:hover{
		background-color: rgba(0,255,132,0.92);
	}
</style>