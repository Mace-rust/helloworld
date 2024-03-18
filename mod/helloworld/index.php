<?php
declare(strict_types=1);

global $PAGE, $OUTPUT;
require_once(__DIR__ . '/../../config.php');

// удостовериться, что пользователь залогинился
require_login();

// Set up the page
$PAGE->set_url('/mod/helloworld/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'mod_helloworld'));
$PAGE->set_heading(get_string('pluginname', 'mod_helloworld'));

// Output the header
echo $OUTPUT->header();

// Display the Hello World message
echo '<div>Hello World!</div>';

// Output the footer
echo $OUTPUT->footer();
