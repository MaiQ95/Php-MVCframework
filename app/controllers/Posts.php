<?php
#[AllowDynamicProperties]
  /**
   *
   */
  class Posts extends Controller{
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users/login');
      }

      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
    }

    public function index(){
      $posts = $this->postModel->getPosts();
      $data = [
        'posts' => $posts
      ];

      $this->view('posts/index', $data);
    }

    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize post
        $_POST = filter_input_array(INPUT_POST);

        // Init data
        $data =[
          'title' => htmlspecialchars(trim($_POST['title'])),
          'body' => htmlspecialchars(trim($_POST['body'])),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => '',
        ];

        // validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }

        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body text';
        }

        // Check for errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Validated
          if ($this->postModel->addPost($data)) {
            flash('post_message', 'Post Added');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load the view with errors
          $this->view('posts/add', $data);
        }

      } else {

      $data = [
        'title' => '',
        'body' => ''
      ];
      $this->view('posts/add', $data);
      }
    }

    // Edit function
    public function edit($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize post
        $_POST = filter_input_array(INPUT_POST);

        // Init data
        $data =[
          'id' => $id,
          'title' => htmlspecialchars(trim($_POST['title'])),
          'body' => htmlspecialchars(trim($_POST['body'])),
          'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'body_err' => '',
        ];

        // validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }

        if(empty($data['body'])){
          $data['body_err'] = 'Please enter body text';
        }

        // Check for errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Validated
          if ($this->postModel->updatePost($data)) {
            flash('post_message', 'Post Edited');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load the view with errors
          $this->view('posts/edit', $data);
        }

      } else {
        // Get existing post from model
        $post = $this->postModel->getPostByID($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }
      $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body
      ];
      $this->view('posts/edit', $data);
      }
    }

    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);

      $data =[
        'post' => $post,
        'user' => $user
      ];

      $this->view('posts/show', $data);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing post from model
        $post = $this->postModel->getPostByID($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }
        
        if($this->postModel->deletePost($id)){
          flash('post_message', 'Post Deleted');
          redirect('posts');
        } else {
          die('Something go wrong');
        }

      } else {
        redirect('posts');
      }
    }
  }

 ?>
