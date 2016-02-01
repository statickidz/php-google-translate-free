<?php

/**
 * GoogleTranslate.class.php
 *
 * Class to talk with Google Translator.
 *
 * @category   Translation
 * @author     Adrián Barrio Andrés
 * @copyright  2016 Adrián Barrio Andrés
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    1.0
 * @link       https://statickidz.com/
 */

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
        $response = self::getStringBetween("onmouseout=\"this.style.backgroundColor='#fff'\">", "</span></div>", strval($response));

        // Clean translation
        $response = self::clean($response);

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
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

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
    protected static function getStringBetween($start = "",$end = "", $string) {
        $temp = strpos($string, $start) + strlen($start);
        $result = substr($string, $temp, strlen($string));
        $dd = strpos($result, $end);
        if($dd == 0){
            $dd = strlen($result);
        }
        return substr($result, 0 ,$dd);
    }

    /**
     * @param string
     * @return string
     */
    protected static function clean($str) {
        $str = strip_tags($str);
        $str = trim($str);
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        return $str;
    }

}
