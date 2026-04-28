<html>
		<head>
			<title><?= relay('title') ?? SITE; ?></title>
			<?= STYLES; ?>
		</head>
	<body>
		<header class="main">
			<div class="container flex items-center justify-between full-h">
				<a 
					class="brand-logo" 
					href="<?= path('/'); ?>"
					title="<?= scribe('common.appName'); ?>"
				>
					<?php include APP['DIR'].'partials/logo.php'; ?>
				</a>

				<button type="button" class="burgerbtn">
					<i></i>
					<i></i>
					<i></i>
				</button>
			</div>
		</header>

		<?= CONTENT; ?>

		<footer id="contact">
			<div class="container flex flex-col items-center justify-center">
				<span><?= scribe('project-in-mind'); ?></span>
				<a href="mailto:m.bartier@arkdevel.be">m.bartier@arkdevel.be</a>
				<a class="clearfix full" href="https://github.com/Poulycroc">
					<div class="flex items-center justify-center gap-1">
						<span>
							200
						</span>
						<span>
							200
						</span>
					</div>
				</a>
			</div>
		</footer>

		<?= SCRIPTS; ?>
	</body>
</html>
