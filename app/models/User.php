<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('select * from users where email = :email');

        $this->db->bind(':email', $email);

        $row = $this->db->row();

        if ($this->db->rowCount() > 0)
        {
            return true;
        }

        else
        {
            return false;
        }


    }

    public function registerUser($data)
    {
     $query = $this->db->query("insert into users (name, email, password) values (:name, :email, :password)");

        try
        {

        //bind values
        $this->db->bind(':name', $data['name']);

        $this->db->bind(':email', $data['email']);

        $this->db->bind(':password', $data['password']);

        //Execute
        $this->db->execute();
            
        return true;
        }

        catch(PDOException $e)
        {

            handleError($query, $e->getMessage());

            
        }      

    }



    
    public function login($data)
    {
        $this->db->query("select * from users where email = :email");

        $this->db->bind(':email', $data['email']);

        $user = $this->db->row();

        $hashed_password = $user->password;
        
        if(password_verify($data['password'], $hashed_password))
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

}






?>