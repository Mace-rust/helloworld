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
        case FEATURE_MOD_PURPOSE:             return MOD_PURPOSE_CONTENT;

        default: return null;
    }
}

function helloworld_add_instance($helloworld) {
    $helloworld->id = insert_record('helloworld', $helloworld);
    return $helloworld->id;
}

function helloworld_update_instance($helloworld) {
    $helloworld->id = $helloworld->instance;
    update_record('helloworld', $helloworld);
    return true;
}

function helloworld_delete_instance($id) {
    return delete_records('helloworld', 'id', $id);
}
