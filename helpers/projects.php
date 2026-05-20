<?php

$projectsOrder = [
  'letec',
  'moovmoov',
  'gimi',
  'qwerteach',
  'thegreenshot',
  'hrpartner',
  'freecaster',
  'wildcodeschool',
  'efp',
  'isfsc',
];

$projects = [];
$dir = APP['DIR'] . 'content/projects';

foreach ($projectsOrder as $slug) {
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
