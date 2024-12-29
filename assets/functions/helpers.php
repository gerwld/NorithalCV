<?php

 /** Adds console.log alternative to PHP (front-end only).
 * @param any $data Any data to display in console.log */

    function consolelog($data)
    {
      $output = $data;
      if (is_array($output)) $output = implode(',', $output);
      echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }


 /** Injects SVG file as a string `<svg .... />`.
 * @param string $relative_path Relative svg path to base_dir 
 * @return string **SVG content** / **\<!-- SVG not found --\>** html comment line */

    function inline_svg($relative_path)
    {
      $svg_file = get_template_directory() . '/' . ltrim($relative_path, '/');
      return (file_exists($svg_file)) ? file_get_contents($svg_file) : '<!-- SVG not found -->';
    }
