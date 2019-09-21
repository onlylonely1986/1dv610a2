<?php

class LogoutView {

    private static $logout = 'LoginView::Logout';
    private static $messageId = 'LoginView::Message';


    public function response() {
        $message = '';
        if(isset($_SESSION['loggedin'])) {
                if (isset($_POST[self::$logout])) {
                    $message = 'Bye, bye!'; // hur ska detta skickas med till vyn nu??
                    $_SESSION['message'] = 'Bye, bye!';
                    session_destroy();
                    header('Location: index.php' );
                    exit;
                } else if (isset($_SESSION['message']) == 'loggedin') {
                    $response = $this->generateLogoutButtonHTML($message);
                    return $response;
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