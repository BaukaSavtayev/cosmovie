<?php

	/*
	=====================================================
	Автор: Савтаев Бауыржан
	Версия: 1.0
	=====================================================
	Файл: index.php
	-----------------------------------------------------
	Назначение: Регистрация пользователей
	=====================================================
	*/
	ini_set("error_reporting", 0);
	ini_set("display_errors", 0);

	define("DATALIFEENGINE", true);
	define("ROOT_DIR", substr(dirname(__FILE__), 0, -26));
	define("ENGINE_DIR", ROOT_DIR."/engine");
	define("TEMPLATE_DIR", ROOT_DIR."/templates");

	// Блок необязательных настроек

	$admin_email = ""; // E-mail администратора
	$subject_for_admin = "Новая регистрация на сайте"; // Тема письма для администратора
	$subject_for_user = "Регистрация на сайте"; // Тема письма для пользователя
	$site_name = ""; // Название сайта

	// Конец блока необязательных настроек

	if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) === "xmlhttprequest") {

		include ENGINE_DIR."/data/config.php";

		date_default_timezone_set($config["date_adjust"]);

		require_once ENGINE_DIR."/classes/mysql.php";
		require_once ENGINE_DIR."/data/dbconfig.php";
		require_once ENGINE_DIR."/modules/functions.php";

		include ENGINE_DIR."/api/api.class.php";

		sleep(1);

		if(!isset($_POST["login"]) || !isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["auth"])) {

			die();

		}

		$not_allow_symbol = array("\x22", "\x60", "\t", '\n', '\r', "\n", "\r", '\\', ",", "/", "#", ";", ":", "~", "[", "]", "{", "}", ")", "(", "*", "^", "%", "$", "<", ">", "?", "!", '"', "'", " ");

		$login = htmlspecialchars(trim((string)$_POST["login"]), ENT_COMPAT, $config["charset"]);
		$login = preg_replace('#\s+#i', " ", $login);

		$password = (string)$_POST["password"];
		$password_clear = htmlspecialchars($password, ENT_COMPAT, $config["charset"]);

		$email = trim(str_replace($not_allow_symbol, "", strip_tags(stripslashes((string)$_POST["email"]))));

		$check = (string)$_POST["auth"];

		$banned_info = get_vars("banned");
		$reg_err_21 = "Администрацией было запрещено использовать данный логин{descr}";
		$reg_err_22 = ", по причине: <b>{descr}</b>.";
		$reg_err_23 = "Администрацией было запрещено использовать данный e-mail{descr}";

		if(!is_array($banned_info)) {

			$banned_info = [];

			$db->query("SELECT * FROM ".USERPREFIX."_banned");

			while($row = $db->get_row()) {

				if($row["users_id"]) {

					$banned_info["users_id"][$row["users_id"]] = [
						"users_id" => $row["users_id"],
						"descr" => stripslashes($row["descr"]),
						"date" => $row["date"]
					];

				} else {

					if(count(explode(".", $row["ip"])) == 4) {

						$banned_info["ip"][$row["ip"]] = [
							"ip" => $row["ip"],
							"descr" => stripslashes($row["descr"]),
							"date" => $row["date"],
						];

					} elseif(strpos($row["ip"], "@") !== false) {

						$banned_info["email"][$row["ip"]] = [
							"email" => $row["ip"],
							"descr" => stripslashes($row["descr"]),
							"date" => $row["date"]
						];

					} else {

						$banned_info["name"][$row["ip"]] = [
							"name" => $row["ip"],
							"descr" => stripslashes($row["descr"]),
							"date" => $row["date"]
						];

					}

				}

			}

			set_vars("banned", $banned_info);

			$db->free();

		}

		if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {

			$admin_email = $config["admin_mail"];

		}

		if($site_name == "") {

			$site_name = $config["home_title"];

		}

		if($subject_for_admin == "") {

			$subject_for_admin = "Новая регистрация на сайте";

		}

		if($subject_for_user == "") {

			$subject_for_user = "Регистрация на сайте";

		}

		if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {

			$user_ip = $_SERVER["HTTP_CF_CONNECTING_IP"];

		} else {

			$user_ip = $_SERVER["REMOTE_ADDR"];

		}

		if(filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {

			$user_ip = filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);

		} elseif(filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {

			$user_ip = filter_var($user_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);

		} else {

			$user_ip = "localhost";

		}

		if(!$config["allow_registration"]) {

			echo "<span class='ms_red_alert'>Администрацией сайта была временно отключена поддержка регистрации на сайте.</span>";

			die();

		}

		if(!$config["allow_registration"] && $config["auth_only_social"]) {

			echo "<span class='ms_red_alert'>Администрацией сайта была включена возможность авторизации на сайте только с использованием социальных сетей. Регистрация на сайте при этом отключена.</span>";

			die();

		}

		if($config["max_users"] > 0) {

			$row = $db->super_query("SELECT COUNT(*) as count FROM ".USERPREFIX."_users");

			if($row["count"] >= $config["max_users"]) {

				echo "<span class='ms_red_alert'>На сайте уже зарегистрировано максимально допустимое количество пользователей. Попробуйте зарегистрироваться позже.</span>";

				die();

			}

		}

		if(!$config["reg_multi_ip"]) {

			$row = $db->super_query("SELECT COUNT(*) as count FROM ".USERPREFIX."_users WHERE logged_ip = '".$user_ip."'");

			if($row["count"]) {

				echo "<span class='ms_red_alert'>Администрацией сайта была запрещена регистрация нескольких аккаунтов на сайте с использованием одного и того же IP. Ваш IP-адрес уже использовался на другом аккаунте.</span>";

				die();

			}

		}

		if(count($banned_info["name"])) {

			foreach($banned_info["name"] as $banned) {

				$banned["name"] = str_replace("\*", ".*", preg_quote($banned["name"], "#"));

				if($banned["name"] and preg_match("#^".$banned["name"]."$#i", $login)) {

					if($banned["descr"]) {

						$reg_err_21 = str_replace("{descr}", $reg_err_22, $reg_err_21);
						$reg_err_21 = str_replace("{descr}", $banned["descr"], $reg_err_21);

					} else {

						$reg_err_21 = str_replace("{descr}", ".", $reg_err_21);

					}

					echo "<span class='ms_red_alert'>".$reg_err_21."</span>";

					die();

				}

			}

		}

		if(count($banned_info["email"])) {

			foreach($banned_info["email"] as $banned) {

				$banned["email"] = str_replace("\*", ".*", preg_quote($banned["email"], "#"));

				if($banned["email"] AND preg_match("#^".$banned["email"]."$#i", $email)) {

					if($banned["descr"]) {

						$reg_err_23 = str_replace("{descr}", $reg_err_22, $reg_err_23);
						$reg_err_23 = str_replace("{descr}", $banned["descr"], $reg_err_23);

					} else {

						$reg_err_23 = str_replace("{descr}", "", $reg_err_23);

					}

					echo "<span class='ms_red_alert'>".$reg_err_23."</span>";

					die();

				}

			}

		}

		if($config["sec_addnews"] && $config["allow_registration"]) {

			$row = $db->super_query("SELECT * FROM ".PREFIX."_spam_log WHERE ip = '".$user_ip."'");

			if(!$row["id"]) {

				include_once ENGINE_DIR."/classes/stopspam.class.php";

				$sfs = new StopSpam($config["spam_api_key"], $config["sec_addnews"]);

				$args = array("ip" => $user_ip);

				if($sfs->is_spammer($args)) {

					$db->query("INSERT INTO ".PREFIX."_spam_log (ip, is_spammer, date) VALUES ('".$user_ip."', '1', '".time()."')");

					echo "<span class='ms_red_alert'>К сожалению, Вы не можете зарегистрироваться на нашем сайте, потому что было зафиксировано, что Ваш IP-адрес ранее использовался для рассылки спама. Если Вы никогда не занимались спамом, значит, Вашим IP-адресом ранее пользовались спамеры. Вам необходимо сменить Ваш IP-адрес у Интернет-провайдера, и Вы сможете зарегистрироваться на нашем сайте.</span>";

					die();

				} else {

					$db->query("INSERT INTO ".PREFIX."_spam_log (ip, is_spammer, date) VALUES ('".$user_ip."', '0', '".time()."')");

				}

			} else {

				if($row["is_spammer"]) {

					echo "<span class='ms_red_alert'>К сожалению, Вы не можете зарегистрироваться на нашем сайте, потому что было зафиксировано, что Ваш IP-адрес ранее использовался для рассылки спама. Если Вы никогда не занимались спамом, значит, Вашим IP-адресом ранее пользовались спамеры. Вам необходимо сменить Ваш IP-адрес у Интернет-провайдера, и Вы сможете зарегистрироваться на нашем сайте.</span>";

					die();

				}

			}

		}

		if(preg_match("/[\||\'|\<|\>|\[|\]|\%|\"|\!|\?|\$|\@|\#|\/|\\\|\&\~\*\{\+]/", $login) || strpos(strtolower($login), ".php") !== false || stripos(urlencode($login), "%AD") !== false) {

			echo "<span class='ms_red_alert'>Вы используете недопустимый логин!</span>";

			die();

		}

		if(dle_strlen(trim($login), $config["charset"]) < 3 || dle_strlen($login, $config["charset"]) > 40) {

			echo "<span class='ms_red_alert'>Логин не может быть менее 3 символов и более 40 символов!</span>";

			die();

		}

		if(strlen($password) < 6 || strlen($password) > 72) {

			echo "<span class='ms_red_alert'>Длина пароля должна быть не менее 6 символов и не более 72 символов!</span>";

			die();

		}

		$attempt_to_register = $dle_api->external_register($login, $password, $email, $config["reg_group"]);

		if($attempt_to_register == "-1") {

			echo "<span class='ms_red_alert'>Указанный логин занят другим пользователем.</span>";

		} elseif($attempt_to_register == "-2") {

			echo "<span class='ms_red_alert'>Указанный e-mail занят другим пользователем.</span>";

		} elseif($attempt_to_register == "-3") {

			echo "<span class='ms_red_alert'>Указанный e-mail не является корректным.</span>";

		} elseif($attempt_to_register == "-4") {

			echo "<span class='ms_red_alert'>Попытка регистрации в несуществующей группе.</span>";

		} else {

			$get_user_id = $dle_api->take_user_by_name($login);

			if($check == "true" && $dle_api->external_auth($login, $password)) {

				$_POST["login_name"] = $login;
				$_POST["login_password"] = $password;
				$_POST["login"] = "submit";

				require_once ENGINE_DIR."/modules/sitelogin.php";

			}

			if(file_exists(TEMPLATE_DIR."/ms_mail_for_user.tpl") && filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {

				$ms_mail_for_user_content = file_get_contents(TEMPLATE_DIR."/ms_mail_for_user.tpl");
				$ms_mail_for_user_content = str_replace("{ms_user_login}", $login, $ms_mail_for_user_content);
				$ms_mail_for_user_content = str_replace("{ms_user_password}", $password_clear, $ms_mail_for_user_content);
				$ms_mail_for_user_content = str_replace("{ms_user_id}", $get_user_id["user_id"], $ms_mail_for_user_content);
				$ms_mail_for_user_content = str_replace("{ms_site_name}", $config["home_title"], $ms_mail_for_user_content);
				$ms_mail_for_user_content = str_replace("{ms_site_url}", $config["http_home_url"], $ms_mail_for_user_content);
				$ms_mail_for_user_content = preg_replace('#<script[^>]*>.*?</script>#is', "", $ms_mail_for_user_content);

				$mail_to = $email;
				$subject = $subject_for_user;
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=utf-8\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "X-MSMail-Priority: High\r\n";
				$headers .= "From: ".$site_name." <".$admin_email.">\r\n";

				mail($mail_to, $subject, $ms_mail_for_user_content, $headers);

			}

			if(file_exists(TEMPLATE_DIR."/ms_mail_for_admin.tpl") && filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {

				$ms_mail_for_admin_content = file_get_contents(TEMPLATE_DIR."/ms_mail_for_admin.tpl");
				$ms_mail_for_admin_content = str_replace("{ms_user_login}", $login, $ms_mail_for_admin_content);
				$ms_mail_for_admin_content = str_replace("{ms_user_email}", $email, $ms_mail_for_admin_content);
				$ms_mail_for_admin_content = str_replace("{ms_user_id}", $get_user_id["user_id"], $ms_mail_for_admin_content);
				$ms_mail_for_admin_content = str_replace("{ms_user_ip}", $user_ip, $ms_mail_for_admin_content);
				$ms_mail_for_admin_content = str_replace("{ms_site_name}", $config["home_title"], $ms_mail_for_admin_content);
				$ms_mail_for_admin_content = str_replace("{ms_site_url}", $config["http_home_url"], $ms_mail_for_admin_content);
				$ms_mail_for_admin_content = preg_replace('#<script[^>]*>.*?</script>#is', "", $ms_mail_for_admin_content);

				$mail_to = $admin_email;
				$subject = $subject_for_admin;
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=utf-8\r\n";
				$headers .= "X-Priority: 1\r\n";
				$headers .= "X-MSMail-Priority: High\r\n";
				$headers .= "From: ".$site_name." <".$admin_email.">\r\n";

				mail($mail_to, $subject, $ms_mail_for_admin_content, $headers);

			}

			echo "<span class='ms_green_alert'>Регистрация прошла успешно!</span><span class='ms_green_alert'>Регистрация прошла успешно!</span> <script>setTimeout(function() { window.location.replace(window.location.pathname); }, 2000);</script>";

		}

	} else {

		die();

	}

?>