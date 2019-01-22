<?php
require_once ('vendor/autoload.php');

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

use \Statickidz\GoogleTranslate;

class TranslateTest extends \PHPUnit\Framework\TestCase
{

    public function testTranslate()
    {
        $source = 'es';
        $target = 'en';
        $text = 'verdadero';

        $trans = new GoogleTranslate();
        $result = $trans->translateGhost($source, $target, $text);

        $this->assertEquals($result, 'true');
    }
}
?>
