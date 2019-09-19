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
		
		// finns det ett post-formulär här?
        if (isset($_POST[self::$login])) {
			// är båda rutorna tomma?
			if (empty($_POST[self::$name]) && empty($_POST[self::$password])) {
				$message .= 'Username is missing';
			// är usernamerutan tom?
			} else if (empty($_POST[self::$name])) {
			   $message .= 'Username is missing';
			// är passwordrutan tom?
           } else if (empty($_POST[self::$password])) {
			   $message .= 'Password is missing';
		   }
		   $this->valueName = $_POST[self::$name];

		   // finns det sparade sessionvariabler
		   if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
			   // båda rutorna är ifyllda med sparade session-variabler
			   $this->valueName = $_SESSION['username'];
			   $this->valuePwd = $_SESSION['password'];
				// nya inloggningsuppgifter sparas i sessionvariablerna
				if ($_POST[self::$name] != $_SESSION['username'] && $_POST[self::$password] != $_SESSION['password']) {
					$_SESSION['username'] = $_POST[self::$name];
					$_SESSION['password'] = $_POST[self::$password];
				}
			}	// user rutan är ifylld med sparad session-variabel
				   // password rutan är ifylld med sparad session-variabel
			// anv loggar in med rätt anv.namn fel lösenord
			if($_POST[self::$name] == 'hej123123' && $_POST[self::$password] != 'hej123123') {
				$message .= 'Wrong username or password';
			} else if ($_POST[self::$name] != 'hej123123' && $_POST[self::$password] == 'hej123123') {
				$message .= 'Wrong username or password';
			}
			// anv loggar in med fel anv.namn rätt lösenord
			
		   
		   
		} else {
			// gör ingenting
		}
		// var_dump($_SESSION);
        $response = $this->generateLoginFormHTML($message);
        return $response;
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

	public function login () {
		if(isset($_POST[self::$login])) {
			if(isset($_SESSION['username']) || isset($_SESSION['password'])) {
				echo 'username eller password är inte satt';
			} else {
				return "Username is missing";
			}
		}
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
}