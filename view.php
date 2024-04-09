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



// Completion and trigger events.
helloworld_view($page, $course, $cm, $context);

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

// Display any activity information (eg completion requirements / dates).
$cminfo = cm_info::create($cm);
$completiondetails = \core_completion\cm_completion_details::get_instance($cminfo, $USER->id);
$activitydates = \core\activity_dates::get_dates_for_module($cminfo, $USER->id);
echo $OUTPUT->activity_information($cminfo, $completiondetails, $activitydates);

if (!empty($options['printintro'])) {
    if (trim(strip_tags($page->intro))) {
        echo $OUTPUT->box_start('mod_introbox', 'pageintro');
        echo format_module_intro('page', $page, $cm->id);
        echo $OUTPUT->box_end();
    }
}

$content = file_rewrite_pluginfile_urls($page->content, 'pluginfile.php', $context->id, 'mod_page', 'content', $page->revision);
$formatoptions = new stdClass;
$formatoptions->noclean = true;
$formatoptions->overflowdiv = true;
$formatoptions->context = $context;
$content = format_text($content, $page->contentformat, $formatoptions);
echo $OUTPUT->box($content, "generalbox center clearfix");

if (!isset($options['printlastmodified']) || !empty($options['printlastmodified'])) {
    $strlastmodified = get_string("lastmodified");
    echo html_writer::div("$strlastmodified: " . userdate($page->timemodified), 'modified');
}

echo $OUTPUT->footer();
