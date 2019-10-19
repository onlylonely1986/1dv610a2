<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	private static $message = '';
	public $valueName = '';
	public $valuePwd = '';

	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$response;
		if(isset($_SESSION['message'])) {
			unset($_SESSION['message']);
		}
		if (isset($_GET['register'])) {
			return;
		} else if (isset($_POST[self::$logout]) && isset($_SESSION['loggedin'])) {
			$response = $this->generateLoginFormHTML(self::$message);
			return $response;
		} else if (isset($_SESSION['loggedin'])) {
			$response = $this->generateLogoutButtonHTML(self::$message);
			return $response;
		} else {
			$response = $this->generateLoginFormHTML(self::$message);
			return $response;
		}
	}
	
	/** 
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="POST" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->valueName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" value="' . $this->valuePwd . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	public function ifLoggedIn () {
		$logged = false;

		if (isset($_POST[self::$logout]) && isset($_SESSION['loggedin'])) {
			$_SESSION['message'] = 'Bye bye!';
			self::$message = $_SESSION['message'];
			unset($_SESSION['loggedin']);
			unset($_SESSION['message']);
			return $logged;
		} else if(isset($_COOKIE['Admin']) && !isset($_SESSION['welcome'])) {
			if($_COOKIE['Admin'] == 'Password') {
				$_SESSION['loggedin'] = 'true';
				$_SESSION['welcome'] = 'true';
				$logged = true;
				self::$message = "Welcome back with cookie";
				return $logged;
			}
		} else if (isset($_SESSION['loggedin']) && isset($_SESSION['welcome'])) {
			self::$message = '';
			unset($_SESSION['welcome']);
			unset($_SESSION['message']);
			$logged = true;
			return $logged;
		} else if (isset($_POST[self::$login])) {
			$this->valueName = $_POST[self::$name];
			
			// är båda rutorna tomma?
			if (empty($_POST[self::$name]) && empty($_POST[self::$password])) {
				self::$message .= 'Username is missing';
				// är username-rutan tom?
			} else if (empty($_POST[self::$name])) {
				self::$message .= 'Username is missing';
				// är password-rutan tom?
			} else if (empty($_POST[self::$password])) {
				self::$message .= 'Password is missing';
				// är lösenordet fel?
			} else if($_POST[self::$name] == 'Admin' && $_POST[self::$password] != 'Password') {
				self::$message .= 'Wrong name or password';
				// är användarnamnet fel?
			} else if ($_POST[self::$name] != 'Admin' && $_POST[self::$password] == 'Password') {
				self::$message .= 'Wrong name or password';
			} else if ($_POST[self::$name] == 'Admin' && $_POST[self::$password] == 'Password') {
				$_SESSION['loggedin'] = 'true';
				$_SESSION['username'] = $_POST[self::$name];
				$_SESSION['message'] = 'Welcome';
				$_SESSION['welcome'] = 'true';
				self::$message = $_SESSION['message'];

				if(isset($_POST[self::$keep])) {
					$cookieName = $_POST[self::$name];
					$cookiePassword = $_POST[self::$password];
					$logged = true;
					setcookie($cookieName, $cookiePassword, time()+3600);
					$_SESSION['rememberMe'] = 'yes';
				}
				$logged = true;
				return $logged;
			} else if ((isset($_SESSION['loggedin'])) && (isset($_SESSION['message']))) {
				$logged = true;
				return $logged;
			}
		}
	}

	public function logout () {

	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
}