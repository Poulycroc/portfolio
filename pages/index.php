<?php relay('title', 'Portfolio - Maxime Bartier'); ?>

<section class="hero">
	<div class="container full-h">
		<div class="hero-content">
			<h1 class="hero-title">
				<span class="hero-line hero-line--accent hero-fade"><?= scribe('home-heroLine1'); ?></span>
				<span class="hero-line hero-line--main hero-fade"><?= scribe('home-heroLine2'); ?></span>
			</h1>
			<p class="hero-subtitle hero-fade"><?= scribe('home-heroSubtitle', [':years' => experienceYears()]); ?></p>
			<a href="#contact" class="btn hero-fade"><?= scribe('home-contactMe'); ?></a>
		</div>

		<div class="hero-bullets hero-fade">
			<ul>
				<li>
					<h5><?= experienceYears(); ?>+</h5>
					<span><?= scribe('hero-bullets--expyears'); ?></span>
				</li>
				<li>
					<h5><?= count(HELPERS['projects']); ?></h5>
					<span><?= scribe('hero-bullets--projects-count'); ?></span>
				</li>
			</ul>
		</div>
	</div>
</section>


<section class="about-me">
	<div class="container">
		<h2 class="section-title reveal"><?= scribe('home-aboutTitle', [':years' => experienceYears()]); ?></h2>
		<article class="reveal"><?= scribe('home-aboutText', [':years' => experienceYears()]); ?></article>
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
