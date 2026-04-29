<html lang="<?= LOCALE['LANGUAGE']; ?>">
		<head>
			<meta charset="utf-8" />
			<title><?= relay('title') ?? SITE; ?></title>
			<meta name="viewport" content="width=device-width,initial-scale=1" />
			<meta name="description" content="<?= relay('metaDescription') ?? scribe('metaDescription'); ?>" />
			<meta name="author" content="Maxime Bartier" />

			<!-- Open Graph -->
			<meta property="og:type" content="website" />
			<meta property="og:title" content="<?= relay('title') ?? SITE; ?>" />
			<meta property="og:description" content="<?= relay('metaDescription') ?? scribe('metaDescription'); ?>" />
			<meta property="og:locale" content="<?= LOCALE['CODE']; ?>" />

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

				<button 
					id="burgerBtn"
					type="button"
					class="burgerbtn"
				>
					<?php for ($i = 0; $i < 4; $i++) { ?>
						<i></i>
					<?php } ?>
				</button>
			</div>

			<div class="full-screen-menu" id="menuContainer"></div>
		</header>

		<main>
			<?= CONTENT; ?>
		</main>

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
