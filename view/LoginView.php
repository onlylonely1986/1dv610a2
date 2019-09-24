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
		// self::$message = '';	
		
		if (isset($_GET['register'])) {
			return;
		} else if (isset($_SESSION['loggedin'])) {
			$response = $this->generateLogoutButtonHTML(self::$message);
			return $response;
		}
		$response = $this->generateLoginFormHTML(self::$message);
		return $response;
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
		// return $loggedIn;
		// $response = $this->generateLogoutButtonHTML(self::$message);
		if (isset($_SESSION['loginReload']) == 'yes') {
			if(isset($_COOKIE['username'])) {
				self::$message = 'Welcome back with cookie';
			} else {
				self::$message = '';
			}
			unset($_SESSION['loginReload']);
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
			} else if($_POST[self::$name] == 'hej123123' && $_POST[self::$password] != 'hej123123') {
				self::$message .= 'Wrong name or password';
				// är användarnamnet fel?
			} else if ($_POST[self::$name] != 'hej123123' && $_POST[self::$password] == 'hej123123') {
				self::$message .= 'Wrong name or password';
			} else if ($_POST[self::$name] == 'hej123123' && $_POST[self::$password] == 'hej123123') {
				$_SESSION['loggedin'] = 'true';
				$_SESSION['message'] = 'Welcome';
				$_SESSION['loginReload'] = 'yes';
				self::$message = $_SESSION['message'];

				if(isset($_POST[self::$keep])) {
					setcookie("username", $_POST[self::$name], time()+3600);
					setcookie("password", $_POST[self::$password], time()+3600);
					$_SESSION['rememberMe'] = 'yes';
				}
				$logged = true;
				return $logged;
			} 
		} else if (isset($_POST[self::$logout])) {
			$_SESSION['message'] = 'Bye bye!';
			self::$message = $_SESSION['message'];
			unset($_SESSION['loggedin']);
			$response = $this->generateLogoutButtonHTML(self::$message);
			$logged = false;
			return $logged;
		} 
	}

	public function logout () {

	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
}