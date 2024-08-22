<?php

require_once('vendor/autoload.php');

// backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}

use \Statickidz\GoogleTranslate;

class TranslateTest extends \PHPUnit\Framework\TestCase
{

    public function testShouldTranslate()
    {
        $source = 'es';
        $target = 'en';
        $text = 'amarillo';

        $trans = new GoogleTranslate();
        $result = strtolower($trans->translate($source, $target, $text));

        $this->assertEquals($result, 'yellow');
    }

    public function testShouldTranslateQuijote()
    {
        $source = 'es';
        $target = 'en';
        $text = 'En un lugar de la Mancha';

        $trans = new GoogleTranslate();
        $result = strtolower($trans->translate($source, $target, $text));

        $this->assertEquals($result, "in a place in la mancha");
    }

    public function testShouldTranslateLongText()
    {
        $source = 'es';
        $target = 'en';
        $text = 'El primer tramo de la ruta consiste en 250 kilómetros y pasa por Mora, La guardia, Alcázar de San Juan, El Toboso (la localidad de Dulcinea) y Belmonte entre otros. ¿Te gustaría transportarte a la época romana? En Mora tendrás esa sensación, mientras que en La Guardia podrás contemplar campos de olivos y humedales, típicos de la zona, ¿o prefieres reconocer escenas descritas por Cervantes? En campo de Criptana, El Toboso y Quintanar de la Orden te sentirás como un personaje del relato.
        Te parecerá encontrarte inmerso en la historia... En Ossa de Montiel con la cueva de Montesinos, se localiza uno de los pasajes más  la novela. En este capítulo, Don Quijote relata a Sancho Panza las visiones mágicas que vio en la cueva. San Clemente y Socuéllamos en Ciudad Real, son dos de sus paradas.
        
        ¡Prueba las exquisitas berenjenas de Almagro y platos a base de jabalí o perdiz con el vino de Valdepeñas! Todo esto te espera en el tercer cuarto tramo de la ruta ¿Su armonía? Un buen queso manchego. Te encantará...
        
        Pero la provincia de Albacete también es parte importante de esta ruta, pues te ofrecerá la posibilidad de degustar la rica gastronomía manchega más tradicional. ¿Su plato más característico? Los galianos, cocinados con tortas, carne de caza, jamón, setas, laurel y tomillo. También son muy populares el atascaburras, la perdiz escabechada, la olla del pastor y el pisto manchego.';

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);

        $this->assertIsString($result);
    }
}
