<?php

require_once APP['DIR'] . 'lib/Parsedown.php';

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
        $meta[trim($key)] = trim($val);
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
    // First part before any h2
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

return true;
