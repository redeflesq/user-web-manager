<?php include __DIR__ . '/../layout/header.php'; ?>

<h2><?= text($isEdit ? 'edit_user' : 'add_new_user') ?></h2>

<?php if (($user && $isEdit) || !$isEdit): ?>

<form method="post"  class="basic-form">
	
	<?php if (isset($error)): ?>
	<div class="error"><?= text($error) ?></div>
	<?php endif; ?>

	<input type="hidden" name="csrf_token" value="<?= Application::i()->csrf()->generateToken()  ?>">

	<label for="login"><?= text('username') ?>:</label>
	<input type="text" name="login" id="login" value="<?= $isEdit ? htmlspecialchars($user['login']) : '' ?>" required>

	<label for="password"><?= text($isEdit ? 'new_password_edit' : 'password') ?>:</label>
	<input type="password" name="password" id="password" <?= $isEdit ? '' : 'required' ?>>

	<label for="first_name"><?= text('first_name') ?>:</label>
	<input type="text" name="first_name" id="first_name" value="<?= $isEdit ? htmlspecialchars($user['first_name']) : '' ?>" required>

	<label for="last_name"><?= text('last_name') ?>:</label>
	<input type="text" name="last_name" id="last_name" value="<?= $isEdit ? htmlspecialchars($user['last_name']) : '' ?>" required>

	<label for="gender"><?= text('gender') ?>:</label>
	<select name="gender" id="gender">
		<option value=""><?= text('select') ?></option>
		<option value="male" <?= $isEdit && $user['gender'] === 'male' ? 'selected' : '' ?>><?= text('male') ?></option>
		<option value="female" <?= $isEdit && $user['gender'] === 'female' ? 'selected' : '' ?>><?= text('female') ?></option>
	</select>

	<label for="birth_date"><?= text('birth_date') ?>:</label>
	<input type="date" name="birth_date" id="birth_date" value="<?= $isEdit ? htmlspecialchars($user['birth_date']) : '' ?>">

	<input type="submit" value="<?= text($isEdit ? 'update' : 'add') ?>">
	<a href="<?= isset($_SESSION['previous_page']) ? htmlspecialchars($_SESSION['previous_page']) : '/user/listUsers' ?>" class="btn"><?= text('cancel') ?></a>
</form>

<?php else: ?>

	<?php if (isset($error)): ?>
	<div class="error"><?= text($error) ?></div>
	<a href="<?= isset($_SESSION['previous_page']) ? htmlspecialchars($_SESSION['previous_page']) : '/user/listUsers' ?>" class="btn"><?= text('cancel') ?></a>
	<?php endif; ?>

<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
