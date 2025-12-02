<?php

class User 
{
	private $db;
	private $table = 'users';

	public function __construct($db) 
	{
		$this->db = $db;
	}

	// Get all users with pagination and optional ordering
	public function getAll($limit = USERS_PER_PAGE, $offset = 0, $orderBy = 'id', $order = 'ASC') 
	{
		$allowedOrderFields = ['id', 'login', 'first_name', 'last_name', 'birth_date'];
		$orderBy = in_array($orderBy, $allowedOrderFields) ? $orderBy : 'id';
		$order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

		$sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$order} LIMIT :limit OFFSET :offset";
		$stmt = $this->db->query($sql, [
			'limit' => (int)$limit,
			'offset' => (int)$offset
		]);

		return $stmt->fetchAll();
	}

	// Get total number of users
	public function getTotalCount() 
	{
		$sql = "SELECT COUNT(*) as count FROM {$this->table}";
		$result = $this->db->fetch($sql);

		return $result['count'] ?? 0;
	}

	// Get a single user by ID
	public function getById($id) 
	{
		$sql = "SELECT * FROM {$this->table} WHERE id = :id";
		return $this->db->fetch($sql, ['id' => $id]);
	}

	// Add a new user
	public function add($data) 
	{
		$sql = "INSERT INTO {$this->table} (login, password, first_name, last_name, gender, birth_date) 
				VALUES (:login, :password, :first_name, :last_name, :gender, :birth_date)";
		$params = [
			'login' => $data['login'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'gender' => $data['gender'],
			'birth_date' => $data['birth_date']
		];

		$this->db->query($sql, $params);
		return $this->db->lastInsertId();
	}

	// Update an existing user
	public function update($id, $data) 
	{
		$fields = [];
		$params = ['id' => $id];

		if (!empty($data['login'])) {
			$fields[] = 'login = :login'; 
			$params['login'] = $data['login'];
		}

		if (!empty($data['password'])) {
			$fields[] = 'password = :password';
			$params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
		}

		if (!empty($data['first_name'])) {
			$fields[] = 'first_name = :first_name';
			$params['first_name'] = $data['first_name'];
		}

		if (!empty($data['last_name'])) {
			$fields[] = 'last_name = :last_name'; 
			$params['last_name'] = $data['last_name'];
		}

		if (!empty($data['gender'])) {
			$fields[] = 'gender = :gender'; 
			$params['gender'] = $data['gender'];
		}

		if (!empty($data['birth_date'])) {
			$fields[] = 'birth_date = :birth_date'; 
			$params['birth_date'] = $data['birth_date'];
		}

		if (empty($fields)) 
			return false;

		$sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
		$this->db->query($sql, $params);
		return true;
	}

	// Delete a user by ID
	public function delete($id) 
	{
		$sql = "DELETE FROM {$this->table} WHERE id = :id";
		$this->db->query($sql, ['id' => $id]);
		return true;
	}
}
