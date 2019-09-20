<?php

class RegisterView {
	private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';

	public function showLink() {
        if (false) {
            return '
                <a href="?">Back to login</a>
                <br/>               
		    ';

        } else {
            return '
                <a href="?register">Register a new user</a> 
		    ';
        }
    }

    public function showForm() {
        return '' . self::generateRegisterFormHTML('') . '';
    }

    public function response() {
    $message = '';
    $response = $this->generateRegisterFormHTML($message);
    return $response;
    }
    
    /** 
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
    private function generateRegisterFormHTML($message) {
		return '
			<form action="?register" enctype="multipart/form-data" method="POST" > 
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId. '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" size="20" value="" />
                    <br/>

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" id="' . self::$password . '" name="' . self::$password . '" size="20" value="" />
                    <br/>

                    <label for="' . self::$passwordRepeat . '">Repeat password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" size="20" value="" />
                    <br/>

					<input type="submit" name="" value="Register" />
				</fieldset>
			</form>
		';
    }
    
    private function  doRegistration() {
        echo 'new registration';
    }
}