<?php

class GoogleTranslate
{

    /**
     * @param string $source
     * @param string $target
     * @param string $text
     * @return string
     */
    public static function translate($source, $target, $text) {

        // Request translation
        $response = self::requestTranslation($source, $target, $text);

        // Get translation text
        $response = self::getStringBetween(";TRANSLATED_TEXT='", "';", strval($response));

        // Clean translation
        $response = self::cleanTranslation($response);

        return $response;
    }

    /**
     * @param string $source
     * @param string $target
     * @param string $text
     * @return array
     */
    protected static function requestTranslation($source, $target, $text) {

        // Google translate URL
        $url = "https://translate.google.com/";

        $fields = array(
            'sl' => urlencode($source),
            'tl' => urlencode($target),
            'js' => urlencode('n'),
            'prev' => urlencode('_t'),
            'hl' => urlencode($source),
            'ie' => urlencode('UTF-8'),
            'text' => urlencode($text),
            'file' => urlencode(''),
            'edit-text' => urlencode('')
        );

        // URL-ify the data for the POST
        $fields_string = "";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
            rtrim($fields_string, '&');

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);

        return $result;
    }

    /**
     * @param string $start
     * @param string $end
     * @param string $string
     * @return string
     */
    protected static function getStringBetween($start = "",$end = "", $string){
        $temp = strpos($string, $start) + strlen($start);
        $result = substr($string, $temp, strlen($string));
        $dd = strpos($result, $end);
        if($dd == 0){
            $dd = strlen($result);
        }
        return substr($result, 0 ,$dd);
    }

    /**
     * @param string $translation
     * @return string
     */
    protected static function cleanTranslation($translation) {
        $translation = preg_replace("#(\\\x[0-9A-Fa-f]{2})#e", "chr(hexdec('\\1'))", $translation);
        $translation = str_replace("<br>", " ", $translation);
        $translation = str_replace("  ", " ", $translation);
        return $translation;
    }

}
