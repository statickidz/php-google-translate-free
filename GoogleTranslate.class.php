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

        // construct full request URL
        $fullUrl = "https://translate.google.com/translate_a/single?"
        . "client=t&"
        . "sl=" . $source
        . "&tl=" . $target
        . "&hl=" . $target
        . "&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t"
        . "&dt=at&ie=UTF-8&oe=UTF-8&otf=1&ssel=0&tsel=0"
        . "&tk=" . self::getRandomToken()
        . "&q=" . urlencode($text);

        // get url content
        $response = self::getUrl($fullUrl);

        // clean translation
        $cleanTranslation = self::cleanTranslation($response);

        // extract translation info
        $dotCount = substr_count($text, ".");
        $result = "";
        if($dotCount == 0) {
            $result .= $cleanTranslation[0];
        } else {
            for($i=0; $i<=$dotCount*2; $i++) {
                if($cleanTranslation[$i] != $source)
                    $result .= $cleanTranslation[$i];
                $i = $i + 1;
            }
        }

        return $result;
    }

    /**
     * @param string $url
     * @return array
     */
    protected static function getUrl($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @return string
     */
    protected static function getRandomToken() {
        $min = 100000;
        $max = 900000;
        $tk1 = mt_rand($min, $max);
        $tk2 = mt_rand($min, $max);
        return $tk1 . "|" . $tk2;
    }

    /**
     * @param string $translation
     * @return string
     */
    protected static function cleanTranslation($translation) {
        $translation = str_replace("[", "", $translation);
        $translation = str_replace("]", "", $translation);
        $parts = explode('"', $translation);
        for($i=0; $i<sizeof($parts); $i++) {
            $part = $parts[$i];
            if($part == ""
                or $part == ","
                or substr_count($part, ',,,') > 0
                or substr_count($part, 'true') > 0
                or substr_count($part, 'false') > 0) 
                    unset($parts[$i]);
        }
        return array_values($parts);
    }

}
