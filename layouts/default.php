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
					title="<?= scribe('appName'); ?>"
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

			<div class="full-screen-menu" id="menuContainer">
				<div class="menu-content">
					<nav class="menu-nav">
						<a href="<?= path('/'); ?>" class="menu-link"><?= scribe('menu-home'); ?></a>
						<a href="<?= path('/#about'); ?>" class="menu-link"><?= scribe('menu-about'); ?></a>
						<a href="<?= path('/#projects'); ?>" class="menu-link"><?= scribe('menu-projects'); ?></a>
						<a href="<?= path('/#contact'); ?>" class="menu-link"><?= scribe('menu-contact'); ?></a>
					</nav>

					<div class="menu-aside">
						<div class="menu-info">
							<span class="menu-info-label"><?= scribe('menu-getInTouch'); ?></span>
							<a href="mailto:m.bartier@arkdevel.be">m.bartier@arkdevel.be</a>
						</div>

						<div class="menu-info">
							<span class="menu-info-label"><?= scribe('menu-socials'); ?></span>
							<a href="https://github.com/Poulycroc" target="_blank" rel="noopener">GitHub</a>
							<a href="https://www.linkedin.com/in/maxime-bartier/" target="_blank" rel="noopener">LinkedIn</a>
						</div>

						<div class="menu-info">
							<span class="menu-info-label"><?= scribe('menu-locale'); ?></span>
							<div class="menu-locales">
								<?php foreach (LOCALES as $locales): ?>
									<?php foreach ($locales as $locale): ?>
										<a
											href="<?= $locale['URI']; ?>"
											class="<?= (defined('LOCALE') && LOCALE['CODE'] === $locale['CODE']) ? 'active' : ''; ?>"
										><?= strtoupper($locale['LANGUAGE']); ?></a>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<main>
			<?= CONTENT; ?>
		</main>

		<footer id="contact">
			<div class="container">
				<div class="footer-cta">
					<span class="footer-label"><?= scribe('project-in-mind'); ?></span>
					<a href="mailto:m.bartier@arkdevel.be" class="footer-email">m.bartier@arkdevel.be</a>
				</div>

				<div class="footer-bottom">
					<div class="footer-links">
						<a href="https://github.com/Poulycroc" target="_blank" rel="noopener">GitHub</a>
						<a href="https://www.linkedin.com/in/maxime-bartier/" target="_blank" rel="noopener">LinkedIn</a>
					</div>

					<div class="footer-sites">
						<a href="https://arklight.be/" target="_blank" rel="noopener">arklight.be</a>
						<a href="https://www.arkdevel.be/" target="_blank" rel="noopener">arkdevel.be</a>
					</div>

					<span class="footer-copy">&copy; <?= date('Y'); ?> Maxime Bartier</span>
				</div>
			</div>
		</footer>

		<?= SCRIPTS; ?>
	</body>
</html>
