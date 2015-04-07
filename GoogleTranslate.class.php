<?php
class GoogleTranslate {

  public function __construct($source = 'es', $target = 'en') {
      $this->source = $source;
      $this->target = $target;
  }

  public function translate($word) {
      $word = urlencode($word);
      $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl='.$this->source.'&sl='.$this->source.'&tl='.$this->target.'&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';      $name_en = $this->curl($url);      $name_en = explode('"',$name_en);
      return  $name_en[1];
  }

  private function curl($url,$params = array(), $is_cookie_set = false) {
    if(!$is_cookie_set){
        $ckfile = tempnam ("/tmp", "CURLCOOKIE");
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec ($ch);
        curl_close($ch);
    }
    $str = '';
    $str_arr= array();
    foreach($params as $key => $value) {
        $str_arr[] = urlencode($key)."=".urlencode($value);
    }
    if(!empty($str_arr))
        $str = '?'.implode('&',$str_arr);
    $finalUrl = $url.$str;
    $ch = curl_init ($finalUrl);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }

}
?>
