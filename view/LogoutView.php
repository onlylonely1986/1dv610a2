<?php

class LogoutView {

    private static $logout = 'LoginView::Logout';
    private static $messageId = 'LoginView::Message';


    public function response() {
        $message = '';
        if(isset($_SESSION['loggedin'])) {
            var_dump($_SESSION);
            // utloggning
            if (isset($_POST[self::$logout])) {
                $_SESSION['message'] = 'Bye bye!';
                unset($_SESSION['loggedin']);
                // in public server use: header('Location: /index.php' );
                header('Location: index.php' );
                exit;
            // fortfarande inloggad reloadar sidan
            } else if (isset($_SESSION['message']) == 'Welcome back with cookie') {
                // echo 'inlogg med cookies';
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            } else if (isset($_SESSION['loginReload']) == 'yes') {

                $message = '';
                unset($_SESSION['firstLogin']);
        
            // nån loggar in första gången och välkommen visas
            } else if (isset($_SESSION['message']) == 'Welcome') {
                // echo 'welcome ska visas';
                $_SESSION['loggedin'] = 'true';
                $_SESSION['message'] = 'Welcome';
                $_SESSION['loginReload'] = 'yes';
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            // inlogg med cookie
            } 
            $response = $this->generateLogoutButtonHTML($message);
            return $response;
        }
    }
    


}