<?php

$projects = [];
$dir = APP['DIR'] . 'content/projects';

foreach (glob("{$dir}/*/") as $projectDir) {
  $slug = basename($projectDir);

  $shared = content("projects/{$slug}/shared.md");
  if (!$shared) continue;

  $meta = $shared['meta'];

  $projects[$slug] = [
    'year' => $meta['year'] ?? '',
    'skills' => $meta['skills'] ?? [],
    'tech' => $meta['tech'] ?? [],
    'showOnLanding' => $meta['showOnLanding'] ?? false,
    'order' => (int) ($meta['order'] ?? 99),
  ];
}

uasort($projects, fn($a, $b) => $a['order'] - $b['order']);

return $projects;
