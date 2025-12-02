<?php include __DIR__ . '/../layout/header.php'; ?>

<h2><?= text('delete_user') ?></h2>

<?php if ($user): ?>
	<p><?=text('are_you_sure_to_delete')?> <strong><?= htmlspecialchars($user['login']) ?></strong>?</p>

	<form method="post"  class="basic-form">
		<input type="hidden" name="csrf_token" value="<?= Application::i()->csrf()->generateToken()  ?>">
		<input type="submit" value="<?= text('yes_delete') ?>" class="btn">
		<a href="/user/listUsers" class="btn"><?= text('cancel') ?></a>
	</form>
<?php else: ?>
	<?php if (isset($error)): ?>
	<div class="error"><?= text($error) ?></div>
	<a href="<?= isset($_SESSION['previous_page']) ? htmlspecialchars($_SESSION['previous_page']) : '/user/listUsers' ?>" class="btn"><?= text('cancel') ?></a>
	<?php endif; ?>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
