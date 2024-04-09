<?php

declare(strict_types=1);

global $OUTPUT, $PAGE;

require('../../config.php');

//$PAGE->set_title('Привет, Мир!');

// Вывод приветственного сообщения.
echo $OUTPUT->header();

echo '<div style="text-align: center; position: absolute; top: 10%; left: 50%; transform: translate(-50%, -50%);">';
echo '<h1>ПРИВЕТ, МИР!!!!</h1>';
echo '</div>';

echo $OUTPUT->footer();
