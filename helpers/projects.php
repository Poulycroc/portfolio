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
  ];
}

return $projects;
