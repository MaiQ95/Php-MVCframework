<?php
#[AllowDynamicProperties]
  /**
   *
   */
  class Pages extends Controller {
    public function __construct(){

    }

    public function index(){

      $data = [
        'title' => 'Welcome',
      ];

      $this->view('pages/index', $data);
    }

    public function main(){

      $data = [
        'title' => 'Home site',
      ];

      $this->view('pages/index', $data);
    }

    public function reports(){

      $data = [
        'title' => 'Reports',
      ];

      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us'
      ];

      $this->view('pages/about', $data);
    }
  }



 ?>
