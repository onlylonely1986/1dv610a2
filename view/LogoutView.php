<?php

class LogoutView {

    private static $logout = 'LoginView::Logout';
    private static $messageId = 'LoginView::Message';


    public function response() {
        if(isset($_SESSION['loggedin'])) {
            $message = 'Welcome';
            $_SESSION['loggedin'] = 'true';
            // ska skicka $isLoggedIn = true och rendera en ny h2 Logged in - detta görs inte i index
            $response = $this->generateLogoutButtonHTML($message);
            return $response;
        }
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
}