<?php
#[AllowDynamicProperties]

  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }
    // Hash password function
    public function hashPassword($password){
      $salt = "writeYourSaltHere";
      $hashPassword = hash("sha512", $salt.$password);
      return $hashPassword;
    }

    public function register(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST);

        // Init data
        $data =[
          'name' => htmlspecialchars(trim($_POST['name'])),
          'email' => htmlspecialchars(trim($_POST['email'])),
          'password' => htmlspecialchars(trim($_POST['password'])),
          'confirm_password' => htmlspecialchars(trim($_POST['confirm_password'])),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
        ];

        // Validate Email
        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter email';
        } else {
          // Check email
          if($this->userModel->findUsersByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate name
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }

        // Validate Password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        } elseif (strlen($data['password']) < 6) {
          $data['password_err'] = 'Password must be at least 6 charackters';
        }

        // Validate Confirm password
        if (empty($data['confirm_password'])) {
          $data['confirm_password_err'] = 'Please confirm password';
        } else {
          if ($data['password'] != $data['confirm_password']) {
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated

          // Hash password
          $data['password'] = $this->hashPassword($data['password']);

          // Register User
          if ($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/login');
          } else {
            die('Something go wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

    } else {
          // Init data
          $data =[
            'name' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
          ];
        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST);

        // Init data
        $data =[
          'email' => htmlspecialchars(trim($_POST['email'])),
          'password' => htmlspecialchars(trim($_POST['password'])),
          'email_err' => '',
          'password_err' => '',
        ];

        // Validate Email
        if (empty($data['email'])) {
          $data['email_err'] = 'Please enter email';
        }

        // Validate Password
        if (empty($data['password'])) {
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUsersByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])) {
          // Validatet

          // Hash password
          $hash = $this->hashPassword($data['password']);

          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $hash);

          if($loggedInUser){
            // Create session
            $this->createUserSession($loggedInUser);
          }else {
            // Password error
            $data['password_err'] = 'Password incorrect';
            // Send errors to login view
            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }

      } else {
        // Init data
        $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];
        // Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('posts');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
  }
 ?>
