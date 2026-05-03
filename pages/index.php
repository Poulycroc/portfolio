<?php relay('title', 'Portfolio - Maxime Bartier'); ?>

<section class="hero">
	<div class="container">
		<div class="hero-content">
			<h1 class="hero-title">
				<span class="hero-line hero-line--accent hero-fade"><?= scribe('home-heroLine1'); ?></span>
				<span class="hero-line hero-line--main hero-fade"><?= scribe('home-heroLine2'); ?></span>
			</h1>
			<p class="hero-subtitle hero-fade"><?= scribe('home-heroSubtitle', [':years' => experienceYears()]); ?></p>
			<div class="clearfix full btn-content">
				<a href="#contact" class="btn hero-fade"><?= scribe('home-contactMe'); ?></a>
			</div>
		</div>

		<div class="hero-bullets hero-fade">
			<div class="container">
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
	</div>
</section>

<section class="about-me" id="about">
	<div class="container">
		<h2 class="section-title reveal"><?= scribe('home-aboutTitle', [':years' => experienceYears()]); ?></h2>
		<div class="content row">
			<div class="col col-6 reveal">
				<span><?= scribe('home-aboutIntro'); ?></span>
			</div>
			<div class="col col-18 reveal">
				<article class="reveal">
					<?= scribe('home-aboutText', [':years' => experienceYears()]); ?>
				</article>
			</div>
		</div>
	</div>
</section>

<section class="my-projects" id="projects">
	<div class="container">
		<h2 class="section-label reveal"><?= scribe('home-projectsTitle'); ?></h2>
		<div class="project-list">
			<?php
				$locale = defined('LOCALE') ? LOCALE['LANGUAGE'] : 'en';
				$index = 0;
				foreach (HELPERS['projects'] as $slug => $project):
					if (empty($project['showOnLanding'])) continue;
					$article = content("projects/{$slug}/{$locale}.md") ?? content("projects/{$slug}/en.md");
					if (!$article) continue;
					$index++;
			?>
				<a href="<?= path("/projects/{$slug}"); ?>" class="project-item reveal">
					<span class="project-index">_<?= str_pad($index, 2, '0', STR_PAD_LEFT); ?>.</span>
					<div class="project-info">
						<h3 class="project-name"><?= $article['meta']['title']; ?></h3>
						<div class="project-card-skills">
							<?php foreach ($project['skills'] as $i => $skill): ?>
								<?php if ($i > 0): ?><span class="skill-dot"></span><?php endif; ?>
								<span><?= $skill; ?></span>
							<?php endforeach; ?>
						</div>
					</div>
					<span class="project-year"><?= $project['year']; ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
