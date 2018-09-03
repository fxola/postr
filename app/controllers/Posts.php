<?php

class Posts Extends Controller
{
    public function __construct()
    {
        //load post model
        $this->postModel = $this->model('Post');


        //Bounce unregistered users from accessing the posts/ post page
        if(!isLoggedIn())
        {
        	redirect('pages/login');
        }
    }



    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $userPost = trim($_POST['post']);

            $userId = $_SESSION['user_id'];

            $posted = $this->postModel->addPost($userPost, $userId);

            if($posted)
            {
                flash('post_success', 'Posted Successfully');
            }

            $userPosts = $this->postModel->getPostDetails();

            $data = [
                'userPosts' => $userPosts
            ];

            $this->view('posts/index', $data);

        }
        else
        {
            //fetch posts
            $userPosts = $this->postModel->getPostDetails();

            $data = [
                'userPosts' => $userPosts
            ];
            
            //load view and pass posts
            $this->view('posts/index', $data);
        }

        
    }


    public function show($id)
    {
        $posts = $this->postModel->getPostById($id);

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/show', $data);
    }

    
}















?>