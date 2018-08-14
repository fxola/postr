<?php

class Posts Extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Post');

        if(!isLoggedIn())
        {
        	redirect('pages/login');
        }
    }



    public function index()
    {

    	$userPosts = $this->postModel->getPosts();

		$data = [
			'userPosts' => $userPosts
		];
		 
    	$this->view('posts/index', $data);
    }


    
}















?>