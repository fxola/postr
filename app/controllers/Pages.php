<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $this->view('pages/index');
    }

    public function about()
    {
        $this->view('pages/about');
    }

    public function register()
	{

        //check for POST
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            //Process form

            //sanitize POST Global
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_error'=>'',
                'email_error'=>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];


            //validate email
            if(empty($data['email']))
            {
                $data['email_error'] = 'Please Enter Email';
            }
            else
            {
                //Check Email
                if($this->userModel->findUserByemail($data['email']))
                {
                    $data['email_error'] = 'Email is Already Taken';  
                }
            }

            //validate name
            if(empty($data['name']))
            {
                $data['name_error'] = 'Please Enter Name';
            }

            //validate password
            if(empty($data['password']))
            {
                $data['password_error'] = 'Please Enter Password';
            }

            elseif (strlen($data['password'] < 6)) 
            {
                $data['password_error'] = 'Password should not be less than 6 characters';
            }

            //validate  confirm password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_error'] = 'Please Enter Password';
            }

            else
            {
                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_error'] = 'Passwords Do not Match';                   
                }
            }

            //Ensure Error is empty
            if(empty($data['name_error']) && empty($data['email_error'] && empty($data['password_error'])) && empty($data['confirm_password_error']) )
            {
                //validated

                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register User 
                if($this->userModel->registerUser($data))
                {
                    //Flash message on successful Registration
                    flash('register_success', 'Registration Successful. You can now proceed to login');

                    //Redirect user to login page after successful registration
                    redirect('pages/login');
                }
                
            }
            else
            {
                $this->view('pages/register', $data);
            }

        }
        else
        { 
            //initialize data
            $data = [
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_error'=>'',
                'email_error'=>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];

            //load view
            $this->view('pages/register', $data);

        }

    }
    
    public function login()
	{

        //check for POST
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            //Process form
            
             //sanitize POST Global
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

             $data = [
                 'email'=>trim($_POST['email']),
                 'password'=>trim($_POST['password']),
                 'email_error'=>'',
                 'password_error'=>'',
             ];
 
 
             //validate email
             if(empty($data['email']))
             {
                 $data['email_error'] = 'Please Enter Email';
             }
            

            //validate password
            if(empty($data['password']))
            {
                $data['password_error'] = 'Please Enter Password';
            }


            //Confirm if User is registered
            if($this->userModel->findUserByEmail($data['email']))
            {
                //User found

            }
            else
            {
                //User not found
                $data['email_error'] = "No Record Found. Please Register";
            }

            if(empty($data['email_error'] && empty($data['password_error'])))
            {
                //validated
                //Check and set logged in user
                $loggedInUser = $this->userModel->login($data);

                if($loggedInUser)
                {
                    //Create Session
                    $this->createUserSession($loggedInUser);
                }
                else
                {
                    $data['password_error'] = 'Incorrect Password';

                    $this->view('pages/login', $data);
                }

            }
            else
            {
                //Load View
                $this->view('pages/login', $data);
            }
 
             
        }
        else
        { 
            //initialize data
            $data = [
                'email'=>'',
                'password'=>'',
                'email_error'=>'',
                'password_error'=>'',
            ];

            //load view
            $this->view('pages/login', $data);

        }

    }
    

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;

        $_SESSION['name'] = $user->name;

        $_SESSION['email'] = $user->email;

        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_id']);

        session_destroy();

        redirect('pages/login');
    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['user_id']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}