<?php
declare(strict_types=1);

global $OUTPUT, $DB;

//defined('MOODLE_INTERNAL') || die();

require('../../config.php');

$id = optional_param('id', 0, PARAM_INT); // Course Module ID
$p = optional_param('helloworld', 0, PARAM_INT);  // Page instance ID

// Проверка, имеет ли текущий пользователь доступ к курсу.
//require_course_login();

// Получение контекста модуля.
//$context = context_module::instance($id); // переменная для проверки прав доступа

// Проверка наличия необходимых прав для просмотра ресурса.
//require_capability('mod/helloworld:view', $context);

// Получение информации о ресурсе.
if ($p) {
    if (!$helloworld = $DB->get_record('helloworld', array('id' => $p))) {
        print_error('invalidaccessparameter');
    }
    $cm = get_coursemodule_from_instance('helloworld', helloworld->id, helloworld->course, false, MUST_EXIST);
} else {
    if (!$cm = get_coursemodule_from_id('helloworld', $id)) {
        print_error('invalidcoursemodule');
    }
    $helloworld = $DB->get_record('helloworld', array('id' => $cm->instance), '*', MUST_EXIST);
}

// Получение информации о курсе.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

//// Установка заголовка страницы.
//$helloworld->set_url('/mod/helloworld/view.php', array('id' => $id));
//$helloworld->set_title($course->shortname . ': ' . helloworld->name);
//$helloworld->set_heading($course->fullname);

// Вывод приветственного сообщения.
echo $OUTPUT->header();

//echo $OUTPUT->heading(format_string("ПРИВЕТ, МИР!!!!"), 1);

// HTML код для контейнера, центрирующего текст
echo '<div style="text-align: center; position: absolute; top: 10%; left: 50%; transform: translate(-50%, -50%);">';

// HTML код для текста
echo '<h1>ПРИВЕТ, МИР!!!!</h1>';

// Закрываем контейнер
echo '</div>';

echo $OUTPUT->footer();
