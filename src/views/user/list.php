<?php include __DIR__ . '/../layout/header.php'; ?>

<?php
// Получаем текущие параметры сортировки
$currentSort = $_GET['sort'] ?? 'id';
$currentOrder = $_GET['order'] ?? 'ASC';

function makeHref($page, $sort = null, $order = null)
{
	$params = [];

	// page
	if ($page > 0) {
		$params['page'] = $page;
	}

	// sort
	if (is_null($sort) && isset($_GET['sort']) && $_GET['sort'] !== '') {
		$params['sort'] = $_GET['sort'];
	} 
	else if (!is_null($sort)) {
		$params['sort'] = $sort;
	}

	// order
	if (is_null($order) && isset($_GET['order']) && $_GET['order'] !== '') {
		$params['order'] = $_GET['order'];
	}
	else if (!is_null($order)) {
		$params['order'] = $order;
	}

	// собрать запрос
	return '?' . http_build_query($params);
}


// Функция для генерации ссылки с переключением порядка
function sortLink($page, $column, $currentSort, $currentOrder, $label)
 {
	// Если это текущий столбец, меняем порядок
	if ($column === $currentSort) {
		$nextOrder = $currentOrder === 'ASC' ? 'DESC' : 'ASC';
	} else {
		$nextOrder = 'ASC'; // по умолчанию
	}
	
	$href = makeHref($page, $column, $nextOrder);
	
	return "<a href=\"{$href}\">" . text($label) . "</a>";
}

function prevButton($page) 
{
	$class = !($page - 1 > 0) ? 'class="disabled"' : '';
	
	$href = makeHref($page - 1);
	
	return "<li><a {$class} href={$href}>".text('prev')."</a></li>";
}

function nextButton($page, $users) 
{
	$class = count($users) !== USERS_PER_PAGE ? 'class="disabled"' : '';
	
	$href = makeHref($page + 1);
	
	return "<li><a {$class} href={$href}>".text('next')."</a></li>";
}

?>

<h2><?= text('user_list') ?></h2>

<a href="/user/form" class="btn"><?= text('add_new_user') ?></a>

<table>
	<thead>
		<tr>
			<th><?= sortLink($page, 'id', $currentSort, $currentOrder, 'id') ?></th>
			<th><?= sortLink($page, 'login', $currentSort, $currentOrder, 'username') ?></th>
			<th><?= sortLink($page, 'first_name', $currentSort, $currentOrder, 'first_name') ?></th>
			<th><?= sortLink($page, 'last_name', $currentSort, $currentOrder, 'last_name') ?></th>
			<th><?= text('actions') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($users)): ?>
			<?php foreach ($users as $user): ?>
				<tr>
					<td><?= htmlspecialchars($user['id']) ?></td>
					<td><?= htmlspecialchars($user['login']) ?></td>
					<td><?= htmlspecialchars($user['first_name']) ?></td>
					<td><?= htmlspecialchars($user['last_name']) ?></td>
					<td>
						<a href="/user/view/<?= $user['id'] ?>"><?= text('view') ?></a> |
						<a href="/user/form/<?= $user['id'] ?>"><?= text('edit') ?></a> |
						<a href="/user/delete/<?= $user['id'] ?>"><?= text('delete') ?></a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan="5"><?= text('no_users_found') ?></td></tr>
		<?php endif; ?>
	</tbody>
</table>

<?php if (isset($users)): ?>
<ul class="pagination">

	<?= prevButton($page) ?>

	<li><a href="?page=<?= $page ?>"><?= $page ?></a></li>

	<?= nextButton($page, $users) ?>

</ul>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>
