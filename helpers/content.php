<?php

require_once APP['DIR'] . 'lib/Parsedown.php';

/**
 * Parse a frontmatter value — handles booleans and comma-separated lists.
 */
function parseFrontmatterValue($val) {
  $val = trim($val);

  if ($val === 'true') return true;
  if ($val === 'false') return false;
  if (strpos($val, ',') !== false) {
    return array_map('trim', explode(',', $val));
  }

  return $val;
}

/**
 * Load a markdown content file with frontmatter.
 * Returns ['meta' => [...], 'body' => 'html', 'sections' => [...]]
 */
function content($path) {
  $file = APP['DIR'] . "content/{$path}";

  if (!file_exists($file)) return null;

  $raw = file_get_contents($file);
  $meta = [];
  $body = $raw;

  // Parse YAML-like frontmatter
  if (preg_match('/^---\s*\n(.*?)\n---\s*\n(.*)/s', $raw, $m)) {
    foreach (explode("\n", trim($m[1])) as $line) {
      if (strpos($line, ':') !== false) {
        list($key, $val) = explode(':', $line, 2);
        $meta[trim($key)] = parseFrontmatterValue($val);
      }
    }
    $body = trim($m[2]);
  }

  $parsedown = new Parsedown();
  $html = $parsedown->text($body);

  // Split body into sections by h2
  $sections = [];
  $parts = preg_split('/<h2>(.*?)<\/h2>/i', $html, -1, PREG_SPLIT_DELIM_CAPTURE);

  if (count($parts) > 1) {
    if (trim($parts[0])) {
      $sections['_intro'] = trim($parts[0]);
    }
    for ($i = 1; $i < count($parts); $i += 2) {
      $key = trim($parts[$i]);
      $sections[$key] = isset($parts[$i + 1]) ? trim($parts[$i + 1]) : '';
    }
  } else {
    $sections['_intro'] = $html;
  }

  return [
    'meta' => $meta,
    'body' => $html,
    'sections' => $sections,
  ];
}

function experienceYears() {
  $earliest = PHP_INT_MAX;
  foreach (HELPERS['projects'] as $slug => $project) {
    if (preg_match('/(\d{4})/', $project['year'], $m)) {
      $earliest = min($earliest, (int) $m[1]);
    }
  }
  return date('Y') - $earliest;
}

return true;
