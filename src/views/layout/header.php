<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= text('admin_panel') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<header style="background-color: #007bff; color: #fff; padding: 8px 20px; display: flex; justify-content: space-between; align-items: center;">
	
		<h1 style="font-size: 20px; margin: 0;"><?=text('admin_panel')?></h1>
		
		<?php if (isset($_SESSION['admin_username'])): ?>
			<div style="float:right;">
				<?= text('logged_in_as') ?> <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong> |
				<a href="/auth/logout" style="color: #fff; text-decoration: underline;"><?= text('logout') ?></a>
			</div>
		<?php endif; ?>
		
	</header>

	<div class="container">
