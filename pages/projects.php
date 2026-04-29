<?php

define('ROUTES', ['*']);

$slug = path(2);

if (! $slug || ! isset(HELPERS['projects'][$slug])) {
    define('REDIRECT', path('/'));

    return;
}

$project = HELPERS['projects'][$slug];
$locale = defined('LOCALE') ? LOCALE['LANGUAGE'] : 'en';
$article = content("projects/{$slug}/{$locale}.md");

if (! $article) {
    $article = content("projects/{$slug}/en.md");
}

if (! $article) {
    define('REDIRECT', path('/'));

    return;
}

relay('title', $article['meta']['title'].' — Maxime Bartier');
relay('metaDescription', $article['meta']['description'] ?? '');
?>

<section class="project-hero">
	<div class="project-block">
		<h1><?= entranceAnimatedTextChar($article['meta']['title']); ?></h1>
		<span class="project-year"><?= $project['year']; ?></span>
	</div>
</section>

<section class="project-detail reveal">
	<div class="project-block">
		<?php if (! empty($article['meta']['description'])) { ?>
			<div class="project-section">
				<p class="project-description"><?= $article['meta']['description']; ?></p>
			</div>
		<?php } ?>

		<?php if (! empty($article['meta']['role'])) { ?>
			<div class="project-section">
				<h2><?= scribe('labels-role') ?? 'Role'; ?></h2>
				<p><?= $article['meta']['role']; ?></p>
			</div>
		<?php } ?>

		<?php foreach ($article['sections'] as $heading => $html) {
			if ($heading === '_intro') continue;
		?>
		<div class="project-section">
			<h2><?= $heading; ?></h2>
			<?= $html; ?>
		</div>
		<?php } ?>

		<?php if (! empty($project['tech'])) { ?>
		<div class="project-section">
			<h2><?= scribe('labels-techStack') ?? 'Tech Stack'; ?></h2>
			<div class="project-tech">
				<?php foreach ($project['tech'] as $tech) { ?>
					<span class="tech-tag"><?= $tech; ?></span>
				<?php } ?>
			</div>
		</div>
		<?php } ?>

	</div>
</section>

<section class="project-bento reveal">
	<div class="project-block">
		<div class="bento-grid">
			<?php
			$picsDir = APP['DIR'] . "content/projects/{$slug}/pics";
			$pics = is_dir($picsDir) ? glob("{$picsDir}/*.{jpg,jpeg,png,webp}", GLOB_BRACE) : [];

			if (! empty($pics)) {
				foreach ($pics as $i => $pic) { ?>
					<div class="bento-item bento-item-<?= $i; ?>">
						<img
							src="/<?= str_replace(APP['DIR'], '', $pic); ?>"
							alt="<?= $article['meta']['title']; ?>"
							loading="lazy"
						/>
					</div>
				<?php }
			} else {
				$sizes = [
					['w' => 800, 'h' => 600],
					['w' => 600, 'h' => 400],
					['w' => 600, 'h' => 800],
					['w' => 800, 'h' => 400],
					['w' => 400, 'h' => 400],
					['w' => 400, 'h' => 600],
				];
				foreach ($sizes as $i => $size) { ?>
					<div class="bento-item bento-item-<?= $i; ?>">
						<img
							src="https://picsum.photos/<?= $size['w']; ?>/<?= $size['h']; ?>?random=<?= crc32($slug . $i); ?>"
							alt="<?= $article['meta']['title']; ?> preview"
							loading="lazy"
						/>
					</div>
				<?php }
			} ?>
		</div>
	</div>
</section>
