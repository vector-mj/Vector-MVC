<?php
foreach (scandir(dirname(__FILE__)) as $fileName) {
  $path = dirname(__FILE__).'/'.$fileName;
  if (is_file($path)) {
    if ($fileName != 'loader.php' && $fileName != '.htaccess') {
      require($path);
    }
  }
}
?>
