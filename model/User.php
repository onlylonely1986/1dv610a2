<?php

namespace Model;

/*
*   User class
*/
class User {

    private $userName = null;
    private $passWord = null;
    private $credentials = false;
    
    /* Method to set a username to a user.
    */
	public function setUserName(string $newUserName)  {
		$this->userName = $newUserName;
    }

    /* Method to set a password to a user.
    */
    public function setPassWord(string $newPassWord) {
        $this->passWord = $newPassWord;
    }

    /* Method to set credentials to a user.
    */
    public function setCredentials(bool $wantsToSaveName) {
        $this->credentials = $wantsToSaveName;
    }

    /* Method to get a username.
    */
	public function getUserName() {
		return $this->userName;
    }

    /* Method to get a oassword. is this nessecary? bad maybe?
    */
    public function getPassword() {
		return $this->passWord;
    }

    /* Method to get credentials, if user wants to save her 
        name/pass in a sessioncookie.
    */
    public function getCredentials() : bool {
		return $this->credentials;
    }
    
    /* Method to see if user has set a username.
    */
	public function hasUserName() : bool {
		return $this->userName != null;
    }
    
    /* Method to see if user has set a password.
    */
    public function hasPassWord() : bool {
		return $this->passWord != null;
	}
}
