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
			<article class="project-section">
				<?php if (is_array(($article['meta']['description']))) { ?>
					<?php foreach ($article['meta']['description'] as $paragraph) { ?>
						<p class="project-description"><?= $paragraph; ?></p>
					<?php } ?>
				<?php } else { ?>
					<p class="project-description"><?= $article['meta']['description']; ?></p>
				<?php } ?>
			</article>
		<?php } ?>

		<?php if (! empty($article['meta']['role'])) { ?>
			<div class="project-section">
				<h2><?= scribe('labels-role') ?? 'Role'; ?></h2>
				<?php if (is_array($article['meta']['role'])) { ?>
					<ul>
						<?php foreach ($article['meta']['role'] as $role) { ?>
							<li><?= $role; ?></li>
						<?php } ?>
					</ul>
				<?php } else { ?>
					<p><?= $article['meta']['role']; ?></p>
				<?php } ?>
			</div>
		<?php } ?>

		<?php foreach ($article['sections'] as $heading => $html) {
		    if ($heading === '_intro') {
		        continue;
		    }
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

<?php
	$picsDir = APP['DIR']."content/projects/{$slug}/pics";
	$pics = is_dir($picsDir) ? glob("{$picsDir}/*.{jpg,jpeg,png,webp}", GLOB_BRACE) : [];

	if (! empty($pics)) {
?>
	<section class="project-bento reveal">
		<div class="project-block">
			<div class="bento-grid">
				<?php
					foreach ($pics as $i => $pic) { ?>
						<div class="bento-item bento-item-<?= $i; ?>">
							<img
								src="/<?= str_replace(APP['DIR'], '', $pic); ?>"
								alt="<?= $article['meta']['title']; ?>"
								loading="lazy"
							/>
						</div>
					<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>

<?php
	$slugs = array_keys(HELPERS['projects']);
	$currentIndex = array_search($slug, $slugs);

	$prevArticle = null;
	$nextArticle = null;

	if ($currentIndex > 0) {
		$prevSlug = $slugs[$currentIndex - 1];
		$prevArticle = content("projects/{$prevSlug}/{$locale}.md") ?? content("projects/{$prevSlug}/en.md");
	}

	if ($currentIndex < count($slugs) - 1) {
		$nextSlug = $slugs[$currentIndex + 1];
		$nextArticle = content("projects/{$nextSlug}/{$locale}.md") ?? content("projects/{$nextSlug}/en.md");
	}
?>

<section class="project-nav reveal">
	<div class="project-block">
		<div class="project-nav-links">
			<?php if ($prevArticle) { ?>
				<a href="<?= path("/projects/{$prevSlug}"); ?>" class="project-nav-link project-nav-link--prev">
					<span class="project-nav-label"><?= scribe('project-prev') ?? 'Previous project'; ?></span>
					<span class="project-nav-title"><?= $prevArticle['meta']['title']; ?></span>
				</a>
			<?php } ?>
			<?php if ($nextArticle) { ?>
				<a href="<?= path("/projects/{$nextSlug}"); ?>" class="project-nav-link project-nav-link--next">
					<span class="project-nav-label"><?= scribe('project-next') ?? 'Next project'; ?></span>
					<span class="project-nav-title"><?= $nextArticle['meta']['title']; ?></span>
				</a>
			<?php } ?>
		</div>
	</div>
</section>
