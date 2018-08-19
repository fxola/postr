<?php
class Post 
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}


	public function getPostDetails()
	{
		//Query db for posts
		$this->db->query("select *, 
							posts.id as postId, 
							users.id as userId
							from posts
							inner join users
							on posts.user_id = users.id
							order by posts.created_at desc");

		return $this->db->resultSet();
	}


	public function addPost($userPost,$userId)
	{

		try
		{
			$query = $this->db->query('insert into posts (post, user_id) values (:userPost , :userId)');

			$this->db->bind(':userPost', $userPost);

			$this->db->bind(':userId', $userId);

			$this->db->execute();

			return true;
		}
		catch(PDOExceoption $e)
		{
			handle_error($query, $e->getMessage());
		}
	}
}
?>