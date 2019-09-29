<?php

// namespace Controller {

    require_once( 'DBSettings.php' );

    class Database extends DatabaseSettings {

        // private $view;
        // private $user;

        public function __construct() {
            /* Connect to a MySQL database using driver invocation */

            // Load settings from parent class
            $settings = DatabaseSettings::getSettings();
            
            // Get the main settings from the array we just loaded
            $host = $settings['dbhost'];
            $name = $settings['dbname'];
            $user = $settings['dbusername'];
            $pass = $settings['dbpassword'];
            $dsn = 'mysql:dbname=' . $name . ';host=' . $host;

            try {
                $dbh = new PDO($dsn, $user, $pass);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }

        }

        public function doChangeUserName()  {

            if ($this->view->userWantsToChangeName()) {

                try {
                    $name = $this->view->getUserName();
                    $this->user->setName($name); 
                } catch (\Exception $e) {
                    $this->view->setNameWasTooShort();
                }
            }
        }
    }
// }
