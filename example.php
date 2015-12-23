<?php

require_once('GoogleTranslate.class.php');

$source = 'es';
$target = 'en';
$text = 'Hola, cuál es tu nombre?';

$translation = GoogleTranslate::translate($source, $target, $text);

echo '<pre>';
print_r($translation);
echo '</pre>';

