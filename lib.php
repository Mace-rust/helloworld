<?php
declare(strict_types=1);

defined('MOODLE_INTERNAL') || die();

/**
 * List of features supported in Page module
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know or string for the module purpose.
 */
function helloworld_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_ARCHETYPE:           return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_GROUPS:                  return false;
        case FEATURE_GROUPINGS:               return false;
        case FEATURE_MOD_INTRO:               return false; //ввод инфы не поддерживаем
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true; //отслеживание просмотров
        case FEATURE_GRADE_HAS_GRADE:         return false;
        case FEATURE_GRADE_OUTCOMES:          return false;
        case FEATURE_BACKUP_MOODLE2:          return true; // резервное копирование
        case FEATURE_SHOW_DESCRIPTION:        return true; // описание плагина
        //case FEATURE_MOD_PURPOSE:             return MOD_PURPOSE_CONTENT;

        default: return null;
    }
}

//function page_get_view_actions() {
//    return array('view','view all');
//}

/**
 * Add page instance.
 * @param stdClass $data
 * @param mod_helloworld_mod_form $mform
 * @return int new helloworld instance id
 */

function helloworld_add_instance($data, $mform = null) {
    global $CFG, $DB;

    require_once("$CFG->libdir/resourcelib.php");

    $cmid = $data->coursemodule;

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
    global $CFG, $DB;

    require_once("$CFG->libdir/resourcelib.php");

    $cmid        = $data->coursemodule;


    $data->id           = $data->instance;
    $DB->update_record('helloworld', $data);
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

//    $cm = get_coursemodule_from_instance('helloworld', $id); //обновляет дату о завершении активности
//    \core_completion\api::update_completion_date_event($cm->id, 'helloworld', $id, null);

    // note: all context files are deleted automatically

    $DB->delete_records('helloworld', array('id'=>$helloworld->id));

    return true;
}
