<?php
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

class TranslateTest extends PHPUnit_Framework_TestCase
{

    public function testTranslate()
    {
        $source = 'es';
        $target = 'en';
        $text = 'verdadero';

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);

        $this->assertEquals($result, 'true');
    }
}
?>