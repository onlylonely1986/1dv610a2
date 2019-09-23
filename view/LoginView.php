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
	// private $message = 'LoginView::Message';
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
		$message = '';
		
		//else if (isset($_SESSION['message']) && $_SESSION['message'] = 'Welcome back with cookie') {
			// echo 'cookie finns';
		//	return;
		// } 
		
	    if (isset($_GET['register'])) {
			return;
		} else if (isset($_SESSION['loggedin'])) {
			// echo 'nån är inloggad ja'; // ja alltid vid inloggad
			return;
			// finns det ett post-formulär här?
		} else if(isset($_SESSION['message']) && $_SESSION['message'] = 'Bye bye!') {
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
		} else if (isset($_POST[self::$login])) {
			$this->valueName = $_POST[self::$name];
			if (isset($_COOKIE['username']) && isset($_COOKIE['username'])) {
				// echo 'finns kaka';
				$this->valueName = $_COOKIE['username'];
				$this->valuePwd = $_COOKIE['password'];
				$_SESSION['loggedin'] = 'true';
				$_SESSION['message'] = 'Welcome back with cookie';
			
			// är båda rutorna tomma?
			} else if (empty($_POST[self::$name]) && empty($_POST[self::$password])) {
				$message .= 'Username is missing';
				// är username-rutan tom?
			} else if (empty($_POST[self::$name])) {
				$message .= 'Username is missing';
				// är password-rutan tom?
			} else if (empty($_POST[self::$password])) {
				$message .= 'Password is missing';
				// är lösenordet fel?
			} else if($_POST[self::$name] == 'hej123123' && $_POST[self::$password] != 'hej123123') {
				$message .= 'Wrong name or password';
				// är användarnamnet fel?
			} else if ($_POST[self::$name] != 'hej123123' && $_POST[self::$password] == 'hej123123') {
				$message .= 'Wrong name or password';
			} else if ($_POST[self::$name] == 'hej123123' && $_POST[self::$password] == 'hej123123') {
				$_SESSION['loggedin'] = 'true';
				$_SESSION['message'] = 'Welcome';
				if($_POST[self::$keep]) {
					setcookie("username", $_POST[self::$name], time()+3600);
					setcookie("password", $_POST[self::$password], time()+3600);
				}

				// in public server use: header('Location: /index.php' );
				header('Location: index.php');
				exit;
			}
		} 
		$response = $this->generateLoginFormHTML($message);
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

	private function login () {

	}

	public function logout () {

	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
}