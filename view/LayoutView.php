<?php

class LayoutView {
  
  public function render($isLoggedIn, $showRegView, LoginView $lv, LogoutView $ov, DateTimeView $dtv, RegisterView $rv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
            ' . $this->renderIsLoggedIn($isLoggedIn) . '
            '  .$rv->showLink($showRegView) . '
            ' . $this->renderRegisterNew($showRegView) . '
          
          <div class="container">
              ' . $lv->response() . '
              ' . $rv->response($showRegView) . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }

  private function renderIsLoggedIn($isLoggedIn) {
    if(isset($_SESSION['loggedin'])) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }

  private function renderRegisterNew($registerNew) {
    if ($registerNew) {
      return '<h2>Register new user</h2>';
    }
    else {
      return '<h2></h2>';
    }
  }
}
