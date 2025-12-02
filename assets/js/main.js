
document.addEventListener('DOMContentLoaded', function() {

	const paginationLinks = document.querySelectorAll('.pagination a');
	paginationLinks.forEach(link => {
		if (link.href === window.location.href) {
			link.classList.add('active');
		}
	});
});
