<?php
declare(strict_types=1);

global $PAGE, $OUTPUT, $DB, $CFG;

require('../../config.php');

$id = required_param('id', PARAM_INT); // course id

$course = $DB->get_record('course', array('id'=>$id), '*', MUST_EXIST);

require_course_login($course, true);

$strpage         = get_string('modulename', 'helloworld');
$strpages        = get_string('modulenameplural', 'helloworld');
$strname         = get_string('name');
$strintro        = get_string('moduleintro');
$strlastmodified = get_string('lastmodified');

$PAGE->set_pagelayout('incourse');
$PAGE->set_url('/mod/helloworld/index.php', array('id' => $course->id));
$PAGE->set_title($course->shortname.': '.$strpages);
$PAGE->set_heading($course->fullname);

$PAGE->navbar->add($strpages);
echo $OUTPUT->header();
echo $OUTPUT->heading($strpages);
if (!$pages = get_all_instances_in_course('page', $course)) {
    notice(get_string('thereareno', 'moodle', $strpages), "$CFG->wwwroot/course/view.php?id=$course->id");
    exit;
}