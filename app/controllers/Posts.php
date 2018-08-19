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


        // if(isLoggedIn())
        // {
        //     redirect('post');
        // }
        //fetch posts
    	$userPosts = $this->postModel->getPostDetails();

		$data = [
			'userPosts' => $userPosts
		];
         
        //load view and pass posts
    	$this->view('posts/index', $data);
    }


    
}















?>