<?php
//declare(strict_types=1);
//
//defined('MOODLE_INTERNAL') || die();
//
//Global $DB, $PAGE, $CFG, $OUTPUT;
//
//require __DIR__ . '/../../config.php';
//
//$id = required_param('id', PARAM_INT); // course id
//
//$course = $DB->get_record('course', array('id'=>$id), '*', MUST_EXIST);
//
//require_course_login($course, true);
//$PAGE->set_pagelayout('incourse');
//
//// Trigger instances list viewed event.
//$event = \mod_page\event\course_module_instance_list_viewed::create(array('context' => context_course::instance($course->id)));
//$event->add_record_snapshot('course', $course);
////для записи и отслеживания информации о том, когда и какие экземпляры модуля курса были просмотрены
//$event->trigger();
//
//$strpage         = get_string('modulename', 'helloworld');
//$strpages        = get_string('modulenameplural', 'helloworld');
//$strname         = get_string('name');
//$strintro        = get_string('moduleintro');
//$strlastmodified = get_string('lastmodified');
//
//$PAGE->set_url('/mod/page/index.php', array('id' => $course->id));
//$PAGE->set_title($course->shortname.': '.$strpages);
//$PAGE->set_heading($course->fullname);
//$PAGE->navbar->add($strpages);
//echo $OUTPUT->header();
//echo $OUTPUT->heading($strpages);
//if (!$pages = get_all_instances_in_course('helloworld', $course)) {
//    notice(get_string('thereareno', 'moodle', $strpages), "$CFG->wwwroot/course/view.php?id=$course->id");
//    exit;
//}
//
////определение структуры таблицы, которая будет отображать список всех страниц в курсе
//$usesections = course_format_uses_sections($course->format);
//
//$table = new html_table();
//$table->attributes['class'] = 'generaltable mod_index';
//
//if ($usesections) {
//    $strsectionname = get_string('sectionname', 'format_'.$course->format);
//    $table->head  = array ($strsectionname, $strname, $strintro);
//    $table->align = array ('center', 'left', 'left');
//} else {
//    $table->head  = array ($strlastmodified, $strname, $strintro);
//    $table->align = array ('left', 'left', 'left');
//}
////заполнение данных в таблице списка страниц в зависимости от наличия разделов в курсе
//$modinfo = get_fast_modinfo($course);
//$currentsection = '';
//foreach ($pages as $page) {
//    $cm = $modinfo->cms[$page->coursemodule];
//    if ($usesections) {
//        $printsection = '';
//        if ($page->section !== $currentsection) {
//            if ($page->section) {
//                $printsection = get_section_name($course, $page->section);
//            }
//            if ($currentsection !== '') {
//                $table->data[] = 'hr';
//            }
//            $currentsection = $page->section;
//        }
//    }
////    else {
////        $printsection = '<span class="smallinfo">'.userdate($page->timemodified)."</span>";
////    }
//
//    $class = $page->visible ? '' : 'class="dimmed"'; // hidden modules are dimmed
//
//    $table->data[] = array (
//        $printsection,
//        "<a $class href=\"view.php?id=$cm->id\">".format_string($page->name)."</a>",
//        format_module_intro('helloworld', $page, $cm->id));
//}
//
//echo html_writer::table($table);
//
//echo $OUTPUT->footer();
