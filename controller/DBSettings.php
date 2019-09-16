<?php 

// namespace Controller {

    /*
    * Class for database settings.
    */
    class DatabaseSettings {
        
        private $settings;
        
        public function getSettings() {
            // Database variables
            $this->settings['dbhost'] = 'localhost';
            
            $this->settings['dbname'] = 'wordpress2019';
            
            $this->settings['dbusername'] = 'root';
            
            $this->settings['dbpassword'] = 'gulavillan91';
            
            return $this->settings;
        }
    }
// }
