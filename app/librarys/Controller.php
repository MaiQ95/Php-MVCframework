<?php
/**
 * Base Controller
 * Loads the models and views
 */
class Controller{
  public function model($model)
  {
    // Require model file
    require_once '../app/models/' . $model . '.php';

    // Instatiate model
    return new $model();
  }

  // Load view
  public function view($view, $data = []){
    if(file_exists('../app/views/' . $view . '.php')){
      require_once '../app/views/' . $view . '.php';
    }else {
      // View does not exists
      die('View does not exists');
    }
  }
}



 ?>
