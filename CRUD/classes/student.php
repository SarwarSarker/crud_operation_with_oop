<?php
include "db.php";
class Student {
	private $table =  'dbt';
	private $username;
	private $email;
	private $password;

	public function setUsername($username){
		$this->username = $username;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function setPassword($password){
		$this->password = $password;
	}
	public function insert(){
		$sql = "INSERT into $this->table(username,email,password) VALUES (:username, :email, :password)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', $this->password);
		return $stmt->execute();
	}
	
	public function update($id){
		$sql = "Update $this->table SET username=:username, email=:email, password=:password where id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':password', $this->password);
		return $stmt->execute();
	}
	public function delete($id){
		$sql = "Update from $this->table   where id=:id";
		$stmt = DB::prepare($sql);
	    $stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();
	}

    public function readById($id){
    	$sql = "select * from $this->table where id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();

    }
    public function deleteById($id){
    	$sql = "Delete  from $this->table where id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		return $stmt->fetch();

    }

	public function readAll()
	{
		$sql = "select * from $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}



?>