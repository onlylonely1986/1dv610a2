<?php

class LogoutView {

    private static $logout = 'LoginView::Logout';
    private static $messageId = 'LoginView::Message';


    public function response() {
        $message = '';
        if(isset($_SESSION['loggedin']) == 'true') {
            // nån trycker på logout
            if (isset($_POST[self::$logout])) {
                $_SESSION['message'] = 'Bye, bye!';
                // $_SESSION['loggedin'] = 'Logging out';
                unset($_SESSION['loggedin']); // $_SESSION['loggedin'] = 'false';
                // session_destroy(); ej rekommenderat att använda utan kör unset($_SESSION[])
                // in public server use: header('Location: /index.php' );
                header('Location: index.php' );
                exit;
            // fortfarande inloggad reloadar sidan
            } else if (isset($_SESSION['message']) == 'loggedin') {
                $_SESSION['loggedin'] = 'true';
                $response = $this->generateLogoutButtonHTML($message);
                return $response;
            // nån loggar in och välkommen visas
            } else {
                $message = 'Welcome';
                $_SESSION['loggedin'] = 'true';
                $_SESSION['message'] = 'loggedin';
                $response = $this->generateLogoutButtonHTML($message);
                return $response;
            }
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