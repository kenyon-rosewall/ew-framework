<?php

class ewUtils
{
	static public function shorten_text($text, $limit)
    {
		$elipse = '&nbsp;...';
		if (strlen($text) < $limit) return $text;

		$text_words = explode(' ', $text);
		$out = null;

		foreach($text_words as $word) {
			if ((strlen($word) > $limit) && $out == null)
				return $word . $elipse;

			if ((strlen($out) + strlen($word)) > $limit) {
				return $out . ' ' . $word . $elipse;
			}
			$out .= ' ' . $word;
		}
		return $out;
    }

  static public function replace_spellings($suggestions, $query)
    {
      foreach ($suggestions as $misspell => $suggestion)
	{
	  $query = str_replace($misspell, '<em>' . $suggestion['suggestion'][0] . '</em>', $query);
	}

      return $query;
    }

  static public function get_uri()
    {
      $uri = str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);
      return $uri;
    }

  static public function get_showcase()
  {
    $dir = 'showcases/';
    $i = 0;

    if (is_dir($dir))
      {
	if ($dh = opendir($dir))
	  {
	    while (($file = readdir($dh)) !== false)
	      {
		if ($file != '.' && $file != '..' && !is_dir($dir.$file))
		  {
		    $i++;
		    $showcases[$i] = $file;
		  }
	      }
	  }
      }

    return $dir.$showcases[rand(1,count($showcases))];
  }

  static public function get_lat_by_ip($ip)
    {
      $arResponse = ewUtils::get_info_by_ip('http://api.hostip.info/get_html.php?ip='.$ip.'&position=true');

      $response = str_replace("Latitude: ","",$arResponse[3]);

      return $response;
    }

  static public function get_long_by_ip($ip)
    {
      $arResponse = ewUtils::get_info_by_ip('http://api.hostip.info/get_html.php?ip='.$ip.'&position=true');

      $response = str_replace("Longitude: ","",$arResponse[4]);

      return $response;
    }

  static public function get_city_by_ip($ip)
    {
      $arResponse = ewUtils::get_info_by_ip('http://api.hostip.info/get_html.php?ip='.$ip);
      $response = str_replace("City: ","",$arResponse[1]);

      return $response;
    }

  static function get_info_by_ip($url)
  {
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
    $arResponse = explode("\n",curl_exec($handle));

    return $arResponse;
  }

  static public function get_base_url($cdn = false)
    {
		$url = $_SERVER['SERVER_NAME'];
		$baseUrls = array("localhost", "dev.explorewisconsin.com", "dev.mossinnovations.com","explorewisconsin.com","www.explorewisconsin.com","2.explorewisconsin.com");
		$rv = '';

		if (!in_array($url,$baseUrls)) {
			$rv = 'http://www.explorewisconsin.com';
		} else {
			if ($_SERVER['SERVER_PORT'] != 80) {
			  $rv = 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
			} else {
			  $rv = 'http://' . $url;
			}
		}

		if ($cdn)
			$rv .= '.nyud.net';

		return $rv;
    }

  static public function is_domain_spotlight()
    {
      if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
	{
	  if ('http://' . $_SERVER['HTTP_X_FORWARDED_HOST'] != ewUtils::get_base_url())
	    return true;
	  else
	    return false;
	}
      else
	{
	  return false;
	}
    }

  static public function remove_term($term,$hay)
    {
      $hay = str_replace('+'.$term.'~ ','',$hay);
      $hay = str_replace('+'.strtoupper($term).'~ ','',$hay);
      $hay = str_replace('+'.ucfirst($term).'~ ','',$hay);

      return $hay;
    }

  static public function slugify($text)
    {
      // replace all non letters or digits by -
      $text = preg_replace('/\W+/', '-', $text);

      // trim
      $text = trim($text, '-');

      if (function_exists('iconv'))
	$text = iconv('Windows-1252','us-ascii//TRANSLIT',$text);

      $text = strtolower($text);

      if (empty($text))
	return '-';

      return $text;
    }

  static public function deslugify($text)
    {
      $text = str_replace('-',' ',$text);
      $text = ucwords($text);
      if (empty($text))
	return '-';

      return $text;
    }

  static public function is_404($url)
    {
      $handle = curl_init($url);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
      
      $response = curl_exec($handle);
      
      $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
      
      if ($httpCode == 404)
	return true;
      else
	return false;
    }

  static public function is_blank($text)
    {
      if (trim($text) == '-' || trim($text) == '' || is_null($text))
	{
	  return true;
	}
      else
	{
	  return false;
	}
    }

  static public function format_phone($phone)
    {
      $phone = preg_replace("/\(?(\d{3})\)?[-\s.]?(\d{3})[-\s.](\d{4})/x", "($1) $2-$3", $phone);
      return $phone;
    }

  static public function is_spotlight($website)
    {
      $type = $website->getWebsiteType()->getName();
      if ($type == 's' || $type == 'l' || $type == 'cs')
	return true;
      else
	return false;
    }

  static public function is_website($website)
    {
      $type = $website->getWebsiteType()->getName();
      if ($type == 'c' || $type == 'w' || $type == 'e')
	return true;
      else
	return false;
     }

  static public function send_email($template, $args, $toaddress, $subject)
    {
      $message = file_get_contents(sfConfig::get('app_root_directory') . '/mail_templates/' . $template);
      $mailer = sfContext::getInstance()->getMailer();
      $mail = $mailer->compose(
			       array('admin@explorewisconsin.com'=>'ExploreWisconsin'),
			       $toaddress,
			       '[EWAlert] ' . $subject,
			       vsprintf($message,$args)
			       );
      $mailer->send($mail);
    }

  static public function get_photo_html($photo)
    {
      $controller = new controller_base();
      
      return $controller->getPartial('/common/_photo',['photo',$photo]);
    }
    
	static public function hide_email($email)
	{
		$out = '';
		for($i=0; $i < strlen($email); $i++) {
			$out .= '&#' . ord($email[$i]) . ';';
		}
		
		return $out;
	}

	static public function create_thumbnail($imageName, $thumbsDir, $thumbWidth)
	{
		if ($imageName == '' || $thumbsDir == '')
			return;

		$thumbsDir = '/'.str_replace('/','',$thumbsDir).'/';
		$imagePath = LOGO_PATH . '/' . $imageName;
		$thumbsPath = LOGO_PATH . $thumbsDir . $imageName;
		$info = pathinfo($imagePath);

		if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg') {
			$img = imagecreatefromjpeg($imagePath);
		} elseif (strtolower($info['extension']) == 'png') {
			$img = imagecreatefrompng($imagePath);
		} else if (strtolower($info['extension']) == 'gif') {
			$img = imagecreatefromgif($imagePath);
		} else {
			copy($imagePath, $thumbsPath);
			return;
		}

		$width = imagesx($img);
		$height = imagesy($img);

		$new_width = $thumbWidth;
		$new_height = floor($height * ($thumbWidth / $width));

		$tmp_img = imagecreatetruecolor($new_width, $new_height);

		imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

		if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg') {
			imagejpeg($tmp_img, $thumbsPath);
		} else if (strtolower($info['extension']) == 'png') {
			imagepng($tmp_img, $thumbsPath);
		} else if (strtolower($info['extension']) == 'gif') {
			imagegif($tmp_img, $thumbsPath);
		} else {
			return;
		}
	}

  static public function create_aemail_image($address, $color, $font, $font_size, $filename, $path, $old_filename)
    {
      $string = $address->getEmail();
      
      $bbox = imagettfbbox($font_size, 0, $font, $string);
      $width = abs($bbox[2] - $bbox[0]);
      $height = abs($bbox[7] - $bbox[1]);
      $x = -abs($bbox[0]);
      $y = $height - abs($bbox[1]);
      
      $image = imagecreatetruecolor($width, $height);
      $background_color = imagecolorallocate($image, 255, 255, 255);
      $text_color = imagecolorallocate($image, $color[0], $color[1], $color[2]);
      imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $background_color);
      
      imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $string);
      
      imagepng($image, $path . $filename);
      imagedestroy($image);

      if (is_file($path . $old_filename))
	unlink($path . $old_filename);
      
      $address->setEmailImage($filename);
    }

  static public function create_email_image($business, $color, $font, $font_size, $filename, $path, $old_filename)
    {
      $string = $business->getEmail();
      
      $bbox = imagettfbbox($font_size, 0, $font, $string);
      $width = abs($bbox[2] - $bbox[0]);
      $height = abs($bbox[7] - $bbox[1]);
      $x = -abs($bbox[0]);
      $y = $height - abs($bbox[1]);
      
      $image = imagecreatetruecolor($width, $height);
      $background_color = imagecolorallocate($image, 255, 255, 255);
      $text_color = imagecolorallocate($image, $color[0], $color[1], $color[2]);
      imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $background_color);
      
      imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $string);
      
      imagepng($image, $path . $filename);
      imagedestroy($image);

      if (is_file($path . $old_filename))
	unlink($path . $old_filename);
      
      $business->setEmailImage($filename);
    }
}

?>