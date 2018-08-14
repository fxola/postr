<?php
class Post 
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}


	public function getPosts()
	{
		$this->db->query("select *, posts.id as postId, 
									users.id as userId
									from posts
									inner join users
									on posts.user_id = users.id
									order by posts.created_at desc");

		return $this->db->resultSet();
	}
}
?>