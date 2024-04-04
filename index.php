<?php
declare(strict_types=1);

global $PAGE, $OUTPUT;
require_once(__DIR__ . '/../../config.php');

// удостовериться, что пользователь залогинился (не обязательно)
require_login();

$PAGE->set_url('/mod/helloworld/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'mod_helloworld'));
$PAGE->set_heading(get_string('pluginname', 'mod_helloworld'));

echo $OUTPUT->header();

echo '<div>Hello World!</div>';

echo $OUTPUT->footer();
