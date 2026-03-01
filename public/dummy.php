<?php
$im = imagecreatetruecolor(100, 100);
$bg = imagecolorallocate($im, 255, 0, 0);
imagefill($im, 0, 0, $bg);
imagepng($im, 'dummy.png');
imagedestroy($im);
?>
