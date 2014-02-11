<?php
  define('HEADER_STYLE', '[V4+ Styles]');
  define('HEADER_EVENT', '[Events]');
  $files = $argv;
  $data = [];
  array_shift($files);
  foreach($files as $f)
    $data[$f] = file_get_contents($f);

  // Read all lines from first file until HEADER_STYLE
  foreach($data as $f => &$v)
  {
    $head = strstr($v, HEADER_STYLE, true);
    if($f == $files[0])
      echo trim($head), PHP_EOL, PHP_EOL, HEADER_STYLE, PHP_EOL;
    $v = trim(substr($v, strlen($head) + strlen(HEADER_STYLE)));
  }
  unset($v);

  // Read all styles
  foreach($data as $f => &$v)
  {
    $styles = strstr($v, HEADER_EVENT, true);
    echo '; ', basename($f), PHP_EOL, PHP_EOL;
    foreach(explode("\n", trim($styles)) as $line)
      if(strncasecmp($line, 'Format', 6) != 0 || $f == $files[0])
        echo trim($line), PHP_EOL;
    echo PHP_EOL;
    $v = trim(substr($v, strlen($styles) + strlen(HEADER_EVENT)));
  }
  unset($v);
  echo HEADER_EVENT, PHP_EOL;

  // Read all events
  foreach($data as $f => &$v)
  {
    echo '; ', basename($f), PHP_EOL, PHP_EOL;
    foreach(explode("\n", trim($v)) as $line)
      if(strncasecmp($line, 'Format', 6) != 0 || $f == $files[0])
        echo trim($line), PHP_EOL;
    echo PHP_EOL;
  }
  unset($v);
