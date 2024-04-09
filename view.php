<?php

declare(strict_types=1);

global $DB, $PAGE, $OUTPUT;
require __DIR__ . '/../../config.php'; // Путь к файлу конфигурации Moodle.

$id = required_param('id', PARAM_INT); // Получение параметра из URL.

// Получение объекта курса.
$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

// Проверка прав доступа.
require_course_login($course, true);

// Установка макета страницы.
$PAGE->set_pagelayout('incourse');

// Установка контекста страницы.
$context = context_course::instance($course->id);
$PAGE->set_context($context);

// Установка URL страницы.
$PAGE->set_url('/mod/helloworld/view.php', array('id' => $course->id));

// Установка заголовка страницы.
$PAGE->set_title($course->shortname . ': ' . get_string('modulenameplural', 'helloworld'));

// Установка хлебных крошек.
$PAGE->navbar->add(get_string('modulenameplural', 'helloworld'));

// Вывод шапки страницы.
echo $OUTPUT->header();

// Вывод контента модуля.

// ...

// Вывод подвала страницы.
echo $OUTPUT->footer();
