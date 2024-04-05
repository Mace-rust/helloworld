<?php
declare(strict_types=1);

global $OUTPUT, $PAGE, $DB;

//defined('MOODLE_INTERNAL') || die();

require('../../config.php');

$id = optional_param('id', 0, PARAM_INT); // Course Module ID
$p = optional_param('helloworld', 0, PARAM_INT);  // Page instance ID

// Проверка, имеет ли текущий пользователь доступ к курсу.
//require_course_login();

// Получение контекста модуля.
$context = context_module::instance($id);

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
echo $OUTPUT->heading(format_string($helloworld->name), 2);

//if (trim(strip_tags($helloworld->intro))) {
//    echo $OUTPUT->box_start('mod_introbox', 'pageintro');
//    echo format_module_intro('helloworld', helloworld, $cm->id);
//    echo $OUTPUT->box_end();
//}

echo $OUTPUT->footer();
