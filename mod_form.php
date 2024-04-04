<?php
declare(strict_types=1);
global $CFG;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/mod/helloworld/locallib.php');

class mod_helloworld_mod_form extends moodleform_mod {

    public function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('modulename', 'helloworld'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');

        //-------------------------------------------------------
        $this->standard_coursemodule_elements();

        //-------------------------------------------------------
        $this->add_action_buttons();
    }
}
