<?php
declare(strict_types=1);

defined('MOODLE_INTERNAL') || die;

function xmldb_helloworld_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2024040500) {

        $table = new xmldb_table('helloworld');
        $field = new xmldb_field('course', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'name');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        upgrade_plugin_savepoint(true, 2024040500, 'mod', 'helloworld');
    }

    return true;
}
