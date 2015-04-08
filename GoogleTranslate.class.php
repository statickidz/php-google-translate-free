<?php
class GoogleTranslate {

  public function __construct($source = 'es', $target = 'en') {
      $this->source = $source;
      $this->target = $target;
  }

  public function translate($word) {
      $word = urlencode($word);
      $url = 'https://translate.google.com/translate_a/single?client=t&sl='.$this->source.'&tl='.$this->target.'&hl='.$this->target.'-419&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&ie=UTF-8&oe=UTF-8&otf=1&ssel=0&tsel=0&tk=519235|682612&q='.$word;
      $name_en = $this->curl($url);
      $name_en = explode('"',$name_en);
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
