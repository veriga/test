<?php
header('content-type: text/html; charset=windows-1251');

  if( $ch = curl_init() ) {
      // розпочинає нову сесію, якщо стара була закриває її
      curl_setopt($ch, CURLOPT_COOKIESESSION, true);
      // файл у якому будуть триматись куки
      curl_setopt($ch, CURLOPT_COOKIEFILE, "cookiefile");
      curl_setopt($ch, CURLOPT_URL, 'http://passport.meta.ua/');

      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HEADER, true);

      curl_setopt($ch, CURLOPT_POSTFIELDS,
          "login=veriga2021&password=veriga");
      $out = curl_exec($ch);
      echo '<pre>' . $out . '</pre>';
      curl_close($ch);
  }
?>

