<?php

declare(strict_types=1);

global $DB, $PAGE, $CFG, $OUTPUT, $USER;

require __DIR__ . '/../../config.php';
require_once($CFG->dirroot.'/mod/helloworld/lib.php');
require_once($CFG->libdir.'/completionlib.php');

$id      = optional_param('id', 0, PARAM_INT); // идентификатор модуля курса
$p       = optional_param('p', 0, PARAM_INT);  // идентификатор экземпляра страницы
$inpopup = optional_param('inpopup', 0, PARAM_BOOL); //открыт ли модуль во всплывающем окне.

if ($p) {
    if (!$page = $DB->get_record('helloworld', array('id' => $p))) {
        print_error('invalidaccessparameter');
    }
    //информации о курсе и модуле курса на основе найденной записи helloworld
    $cm = get_coursemodule_from_instance('helloworld', $page->id, $page->course, false, MUST_EXIST);

} else {
    //информация о модуле курса helloworld на основе id
    if (!$cm = get_coursemodule_from_id('helloworld', $id)) {
        print_error('invalidcoursemodule');
    }
    $page = $DB->get_record('helloworld', array('id' => $cm->instance), '*', MUST_EXIST);
}
//$page = запись экземпляра модуля helloworld
//$cm = информация о курсе и модуле курса, связанных с этим экземпляром.


$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);

//Проверка, авторизован ли текущий пользователь для доступа к курсу. Если пользователь не авторизован, он будет перенаправлен на страницу входа.
require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/helloworld:view', $context); //непосредственно проверка доступа



// События завершения и запуска.
helloworld_view($page, $course, $cm, $context);

//установка заголовка страницы и ее оформления
$PAGE->set_url('/mod/helloworld/view.php', array('id' => $cm->id));

$options = empty($page->displayoptions) ? [] : (array) unserialize_array($page->displayoptions);

if ($inpopup and $page->display == RESOURCELIB_DISPLAY_POPUP) {
    $PAGE->set_pagelayout('popup');
    $PAGE->set_title($course->shortname.': '.$page->name);
    $PAGE->set_heading($course->fullname);
} else {
    $PAGE->set_title($course->shortname.': '.$page->name);
    $PAGE->set_heading($course->fullname);
    $PAGE->set_activity_record($page);
}

echo $OUTPUT->header();

if (!isset($options['printheading']) || !empty($options['printheading'])) {
    echo $OUTPUT->heading(format_string($page->name), 2);
}

$userid = intval($USER->id); // user id to int
// Display any activity information (eg completion requirements / dates).
$cminfo = cm_info::create($cm);
$completiondetails = \core_completion\cm_completion_details::get_instance($cminfo, $userid);
$activitydates = \core\activity_dates::get_dates_for_module($cminfo, $userid);
echo $OUTPUT->activity_information($cminfo, $completiondetails, $activitydates); // непосредственно кнопка выполненности

//$formatoptions = new stdClass;
//$formatoptions->noclean = true; // отключение очистки HTML-кода
//$formatoptions->overflowdiv = true; // переполнение, если содержимое не помещается в указанную область
//$formatoptions->context = $context; // чтобы применять соответствующие правила безопасности

echo $OUTPUT->footer();
