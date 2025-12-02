<?php include __DIR__ . '/../layout/header.php'; ?>

<h2><?= text('view_user') ?></h2>

<?php if ($user): ?>
	<p><strong><?= text('id') ?>:</strong> <?= htmlspecialchars($user['id']) ?></p>
	<p><strong><?= text('username') ?>:</strong> <?= htmlspecialchars($user['login']) ?></p>
	<p><strong><?= text('first_name') ?>:</strong> <?= htmlspecialchars($user['first_name']) ?></p>
	<p><strong><?= text('last_name') ?>:</strong> <?= htmlspecialchars($user['last_name']) ?></p>
	<p><strong><?= text('gender') ?>:</strong> <?= text($user['gender']) ?></p>
	<p><strong><?= text('birth_date') ?>:</strong> <?= htmlspecialchars($user['birth_date']) ?></p>

	<a href="/user/form/<?= $user['id'] ?>" class="btn"><?= text('edit') ?></a>
	<a href="/user/delete/<?= $user['id'] ?>" class="btn"><?= text('delete') ?></a>
	<a href="<?= isset($_SESSION['previous_page']) ? htmlspecialchars($_SESSION['previous_page']) : '/user/listUsers' ?>" class="btn"><?= text('back_to_list') ?></a>
<?php else: ?>
	<?php if (isset($error)): ?>
	<div class="error"><?= text($error) ?></div>
	<a href="<?= isset($_SESSION['previous_page']) ? htmlspecialchars($_SESSION['previous_page']) : '/user/listUsers' ?>" class="btn"><?= text('cancel') ?></a>
	<?php endif; ?>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
