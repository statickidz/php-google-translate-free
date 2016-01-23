<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('GoogleTranslate.class.php');

$source = 'es';
$target = 'en';
$text = "'Destiny' tiene un problema con el balance de sus armas y en Bungie lo saben mejor que nadie. Durante el último año, numerosas han sido las actualizaciones que han ido haciendo ajustes a todos los niveles, más pequeños o más grandes, en busca de un equilibrio que es prácticamente imposible, todo ello en su afán de conseguir que todas las familias de armas puedan resultar igual de relevantes.En la práctica, esto se ha traducido muchas veces en desnudar un santo para vestir a otro, haciendo que al final hubiera siempre una familia de armas que se impusiera sobre el resto en cuanto a porcentaje de uso, algo que a Bungie no parece gustarle nada. Con 'El Rey de los Poseídos', eso es cierto, se ha alcanzado un punto medianamente aceptable, al menos si lo comparamos con el periodo de terror que cañones de mano y escopetas habían impuesto en los meses anteriores, pero la situación dista de ser perfecta, y ahora son los fusiles de pulsos quienes copan el mayor protagonismo en 'Destiny'. Diciembre ha sido elegido por sus creadores para lanzar una nueva actualización a gran escala que volverá a cambiar las reglas del juego por completo. ¿Era necesaria? En mi opinión, no especialmente, o al menos no al nivel que se está planteando, pero imagino que son ellos quienes tienen los datos más apropiados y, por tanto, quienes pueden actuar en consecuencia. Está por ver si con ello consiguen equilibrar aún más la complicada balanza entre familias de armas, algo especialmente difícil si tenemos en cuenta además los imposibles paralelismos entre modalidades PvP y PvE, o vuelven a romper la baraja como ya pasó en anteriores ocasiones.";

$translation = GoogleTranslate::translate($source, $target, $text);

echo '<pre>';
print_r($translation);
echo '</pre>';

