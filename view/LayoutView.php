<?php

class LayoutView {
  
  public function render($isLoggedIn, $registerNew, LoginView $v, DateTimeView $dtv, RegisterView $rv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          '  .$rv->showLink($registerNew) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          ' . $this->renderRegisterNew($registerNew) . '
          
          <div class="container">
              ' . $v->response() . '
              ' . $rv->response($registerNew) . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
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
