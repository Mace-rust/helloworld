<?php
declare(strict_types=1);

defined('MOODLE_INTERNAL') || die();

/**
 * List of features supported in Page module
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know or string for the module purpose.
 */
function helloworld_supports($feature)
{
    switch ($feature) {
        case FEATURE_MOD_ARCHETYPE:
            return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_GROUPS:
            return false;
        case FEATURE_GROUPINGS:
            return false;
        case FEATURE_MOD_INTRO:
            return false; //ввод инфы не поддерживаем
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return false; //отслеживание просмотров
        case FEATURE_GRADE_HAS_GRADE:
            return false;
        case FEATURE_GRADE_OUTCOMES:
            return false;
        case FEATURE_BACKUP_MOODLE2:
            return false; // резервное копирование
        case FEATURE_SHOW_DESCRIPTION:
            return true; // описание плагина

        default:
            return null;
    }
}


/**
 * Add page instance.
 * @param stdClass $data
 * @param mod_helloworld_mod_form $mform
 * @return int new helloworld instance id
 */

function helloworld_add_instance($data, $mform = null)
{
    global $DB;

    $data->id = $DB->insert_record('helloworld', $data);

    return $data->id;
}

/**
 * Update page instance.
 * @param object $data
 * @param object $mform
 * @return bool true
 */
function helloworld_update_instance($data, $mform) {
    global $DB;

    $data->id           = $data->instance;
    $DB->update_record('helloworld', $data);

    return true;
}

/**
 * Delete page instance.
 * @param int $id
 * @return bool true
 */
function helloworld_delete_instance($id) {
    global $DB;

    if (!$helloworld = $DB->get_record('helloworld', array('id'=>$id))) {
        return false;
    }


    $DB->delete_records('helloworld', array('id'=>$helloworld->id));

    return true;
}

function helloworld_view($page, $course, $cm, $context) {

    // Trigger course_module_viewed event.
    $params = array(
        'context' => $context,
        'objectid' => $page->id
    );

    $event = \mod_helloworld\event\course_module_viewed::create($params);
    $event->add_record_snapshot('course_modules', $cm);
    $event->add_record_snapshot('course', $course);
    $event->add_record_snapshot('helloworld', $page);
    $event->trigger();

    $completion = new completion_info($course);
    $completion->set_module_viewed($cm); //Пометка модуля как просмотренного для учета завершения курса
}

