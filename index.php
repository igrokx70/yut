<?php header("Content-Type: text/html; charset=utf-8");

$content = file_get_contents("http://www.dailymotion.com/video/".$_GET['id']); 
$res = preg_match("/<title>(.*) - Видео Dailymotion<\/title>/siU", $content, $title_matches);

$title = preg_replace('/\s+/', ' ', $title_matches[1]);
$id = $_GET['id'];

if (file_exists($id)) {
    goto a;

} else {
    goto b;
}

b:
$dir = mkdir($id);
$res1 = preg_match("/<link rel=\"image_src\" type=\"image\/jpeg\" href=\"(.*)\" \/>/siU", $content, $title_matches1);
$img = preg_replace('/\s+/', ' ', $title_matches1[1]);

$im1 = imagecreatefromjpeg($img);
// ��������� ����������� � 'simpl.jpg'
imagejpeg($im1, "$id/simpl.jpg", 100);

include('SimpleImage.php');    
   $image = new SimpleImage();   
   $image->load("$id/simpl.jpg");   
   $image->resampleToWidth(720);   
   $image->sharpen();            
   $image->save("$id/simpl1.jpg");  

$im10 = imagecreatefromjpeg("$id/simpl1.jpg");
$im20 = imagecreatefromjpeg('niz.jpg'); 
$x = (imagesx($im10) - imagesx($im20)) / 2;
$y = (imagesy($im10) - imagesy($im20)) / 1; 

imagesavealpha($im10, true); 
imagecopy($im10, $im20, $x, $y, 0, 0, imagesx($im20), imagesy($im20));
imagejpeg($im10, "$id/simpl2.jpg", 100);

$im1 = imagecreatefromjpeg("$id/simpl2.jpg");
$im2 = imagecreatefrompng('play13.png'); 
$x = (imagesx($im1) - imagesx($im2)) / 2;
$y = ((imagesy($im1) - imagesy($im2)) / 2) - 40; 

imagesavealpha($im1, true); 
imagecopy($im1, $im2, $x, $y, 0, 0, imagesx($im2), imagesy($im2));
imagejpeg($im1, "$id/simpl3.jpg", 100);

$im = imagecreatefromjpeg("$id/simpl3.jpg");
$x = 25;
$y = ((imagesy($im10) - imagesy($im20)) / 1)+20; 
// �������� ������
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$text = $title;
$font = './arial.ttf';
imagefttext($im, 14, 0, $x, $y, $black, $font, $text);
imagejpeg($im, "$id/simpl4.jpg", 100);

$z = rand(3547, 32000);
$im = imagecreatefromjpeg("$id/simpl4.jpg");
$x = 25;
$y = ((imagesy($im10) - imagesy($im20)) / 1)+40; 
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$text = "$z ����������";
$text = iconv('WINDOWS-1251', 'UTF-8', $text); 
$font = './arial.ttf';
imagefttext($im, 12, 0, $x, $y, $grey, $font, $text);
imagejpeg($im, "$id/simpl4.jpg", 100);

unlink ("$id/simpl.jpg");
unlink ("$id/simpl1.jpg");
unlink ("$id/simpl2.jpg");
unlink ("$id/simpl3.jpg");
a:
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xml:lang="ru" lang="ru">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>  
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo($title);?></title> 
  <meta property="og:image" content="/Urez/<?php echo($id);?>/simpl4.jpg" />
  <meta property="og:url" content="http://www.dailymotion.com/video/<?php echo($id);?>" />
  <meta property="og:video:iframe" content="http://www.dailymotion.com/swf/video/<?php echo($id);?>?autoPlay=1" />
  <meta property="og:video:type" content="application/x-shockwave-flash" />
  <meta property="og:video:width" content="720" />
  <meta property="og:video:height" content="410" />
  <link rel="canonical" href="http://www.dailymotion.com/video/<?php echo($id);?>" />
  <meta property="og:title" content="<?php echo($title);?>" />
</head>
<body onresize="onBodyResize()" class="is_rtl font_default pads ">
<center><iframe frameborder="0" width="640" height="480" src="//www.dailymotion.com/embed/video/<?php echo($id);?>?autoplay=1" allowfullscreen></iframe><br /></center>
</body>
</html>