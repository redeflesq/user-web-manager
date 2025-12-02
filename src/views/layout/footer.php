	</div> <!-- /.container -->

	<footer style="display: flex; justify-content: space-around; text-align:center; padding:10px 0; margin-top:20px; border-top:1px solid #ddd;">
		&copy; <?= date('Y') ?> <?= text('my_admin_panel') ?>
				<form method="get" style="margin:0;" >
	<select name="lang" onchange="this.form.submit()" style="
		padding:2px 6px;		 
		margin:0;
		font-size:12px;		  
		border:none;			  
		border-radius:3px;		
		background:#fff;		 
		color:#000;
		cursor:pointer;
		appearance:none;		  
		-webkit-appearance:none;
		-moz-appearance:none;
		background-image: url('data:image/svg+xml;utf8,<svg fill=\'%23000\' height=\'6\' viewBox=\'0 0 20 20\' width=\'10\' xmlns=\'http://www.w3.org/2000/svg\'><polygon points=\'0,0 20,0 10,10\'/></svg>');
		background-repeat:no-repeat;
		background-position:right 3px center;
	">
		<?php foreach (Application::i()->translator()->available_langs as $code => $path): ?>
			<option value="<?= htmlspecialchars($code) ?>" <?= ($code === Application::i()->translator()->lang ? 'selected' : '') ?>>
				<?= strtoupper($code) ?>
			</option>
		<?php endforeach; ?>
	</select>
</form>
	</footer>

	<!-- JS -->
	<script src="/assets/js/main.js"></script>
</body>
</html>
