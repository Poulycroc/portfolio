<?php relay('title', 'Portfolio - Maxime Bartier'); ?>

<section class="hero">
	<div class="container flex items-center justify-between full-h">
		<div class="hero-content">
			<h1><?= scribe('home.heroTitle'); ?></h1>
			<p><?= scribe('home.heroSubtitle'); ?></p>
			<a href="#contact" class="btn"><?= scribe('home.contactMe'); ?></a>
		</div>

		<div class="hero-image">
		</div>
	</div>
</section>


<section class="about-me">
	<div class="container">

	</div>
</section>
<section class="my-stack">
	<div class="container">

	</div>
</section>
<section class="my-projects">
	<div class="container">
		<?php
		$locale = defined('LOCALE') ? LOCALE['LANGUAGE'] : 'en';
		foreach (HELPERS['projects'] as $slug => $project):
			if (empty($project['showOnLanding'])) continue;
			$article = content("projects/{$slug}/{$locale}.md") ?? content("projects/{$slug}/en.md");
			if (!$article) continue;
		?>
			<a href="<?= path("/projects/{$slug}"); ?>" class="project-card">
				<h3><?= $article['meta']['title']; ?></h3>
				<div class="project-card-skills">
					<?php foreach ($project['skills'] as $skill): ?>
						<span><?= $skill; ?></span>
					<?php endforeach; ?>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</section>
