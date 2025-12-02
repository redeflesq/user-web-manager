<?php

class UserController 
{
	private $userModel;

	public function __construct($app) 
	{
		$this->app = $app;
		$this->userModel = new User($app->db());
	}
	
	private function getPage()
	{
		// Get current page number from query string, default to 1
		$page = $_GET['page'] ?? 1;
		if (!is_numeric($page))
			$page = 1;
		else if($page <= 0)
			$page = 1;
		return $page;
	}
	
	private function getOrderBy()
	{
		// Get sorting field from query string, default to 'id'
		$orderBy = $_GET['sort'] ?? 'id';
		switch(strtolower($orderBy))
		{
			case "id":
			case "username":
			case "first_name":
			case "last_name": return $orderBy;
			default: return 'id';
		}
	}
	
	private function getOrder()
	{
		// Get sorting order from query string, default to 'ASC'
		$order = $_GET['order'] ?? 'ASC';
		switch(strtoupper($order))
		{
			case "ASC":
			case "DESC": return $order;
			default: return "ASC";
		}
	}

	// Display paginated list of users
	public function listUsers() 
	{
		$page = $this->getPage();
		$limit = USERS_PER_PAGE;
		$offset = ($page - 1) * $limit;
		$orderBy = $this->getOrderBy();
		$order = $this->getOrder();
		$users = $this->userModel->getAll($limit, $offset, $orderBy, $order);

		$_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];

		Application::i()->renderer()->render('user', 'list', [
			'page' => $page,
			'limit' => $limit,
			'offset' => $offset,
			'orderBy' => $orderBy,
			'order' => $order,
			'users' => $users,
		]);
	}

	// Display a single user's details
	public function view($id) 
	{
		$user = $this->userModel->getById($id);

		if (!$user)
			$error = "user_not_found";

		$vars = ['user' => $user];
		if (isset($error))
			$vars['error'] = $error;

		Application::i()->renderer()->render('user', 'view', $vars);
	}

	// Display and handle user add/edit form
	public function form($id = null) 
	{
		$isEdit = false;
		$user = null;

		if ($id) {
			$user = $this->userModel->getById($id);
			if (!$user)
				$error = "user_not_found";
			$isEdit = true;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$csrfToken = $_POST[$this->app->csrf()->variableName()] ?? '';

			// CSRF token validation
			if (!$this->app->csrf()->checkToken($csrfToken)) {
				$error = 'invalid_csrf';
			} else {
				
				try {	
				
					 $data = [
						'login' => $_POST['login'] ?? '',
						'password' => $_POST['password'] ?? '',
						'first_name' => $_POST['first_name'] ?? '',
						'last_name' => $_POST['last_name'] ?? '',
						'gender' => $_POST['gender'] ?? '',
						'birth_date' => $_POST['birth_date'] ?? ''
					];
					
					
					if (strlen($data['login']) < 4) {
						throw new Exception('invalid_username');
					}
					
					if (strlen($data['first_name']) < 3) {
						throw new Exception('invalid_first_name');
					}
					
					if (strlen($data['last_name']) < 3) {
						throw new Exception('invalid_last_name');
					}
					
					if ($isEdit) {
						// Update user
						if (empty($data['password']) || strlen($data['password']) >= 6) {
							if ($this->userModel->update($id, $data)) {
								$this->app->router()->setLocation('/user/listUsers');
							} else {
								$error = "update_failed";
							}
						} else {
							$error = "incorrect_pass";
						}
					} else {
						// Add new user
						if (!empty($data['password']) && strlen($data['password']) >= 6) {
							$this->userModel->add($data);
							$this->app->router()->setLocation('/user/listUsers');
						} else {
							$error = "incorrect_pass";
						}
					}

				} catch (Exception $e) {
					
					if (isset($e->errorInfo) && isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
						$error = 'duplicated_entry_user_err';
					}
					else {
						$error = $e->getMessage();
					}
				}
			}
		}

		$vars = ['user' => $user, 'isEdit' => $isEdit];
		if (isset($error))
			$vars['error'] = $error;

		Application::i()->renderer()->render('user', 'form', $vars);
	}

	// Handle user deletion
	public function delete($id) 
	{
		$user = $this->userModel->getById($id);

		if (!$user)
			$error = "user_not_found";

		if ($user && $_SERVER['REQUEST_METHOD'] === 'POST') {
			$csrfToken = $_POST[$this->app->csrf()->variableName()] ?? '';

			// CSRF token validation
			if (!$this->app->csrf()->checkToken($csrfToken)) {
				$error = "invalid_csrf";
			} else {
				$this->userModel->delete($id);
				$this->app->router()->setLocation('/user/listUsers');
			}
		}

		$vars = ['user' => $user];
		if (isset($error))
			$vars['error'] = $error;

		Application::i()->renderer()->render('user', 'delete', $vars);
	}
}
