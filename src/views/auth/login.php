<?php include __DIR__ . '/../layout/header.php'; ?>

<h2><?=text('admin_login')?></h2>

<?php if (isset($error)): ?>
	<div class="error"><?= text($error) ?></div>
<?php endif; ?>

<form method="post" action="" class="basic-form">
	<input type="hidden" name="csrf_token" value="<?= Application::i()->csrf()->generateToken() ?>">
	
	<label for="username"><?=text('username')?>:</label>
	<input type="text" name="username" id="username" required>

	<label for="password"><?=text('password')?>:</label>
	<input type="password" name="password" id="password" required>

	<input type="submit" value="<?=text('login')?>">
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>
