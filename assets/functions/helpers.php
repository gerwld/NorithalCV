<?php

// Add console.log alternative
function consolelog($data)
{
  $output = $data;
  if (is_array($output)) $output = implode(',', $output);
  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}



// Injects inline svg's if they exist
function inline_svg($relative_path)
{
  $svg_file = get_template_directory() . '/' . ltrim($relative_path, '/');
  return (file_exists($svg_file)) ? file_get_contents($svg_file) : '<!-- SVG not found -->';
}
