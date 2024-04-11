<?php
declare(strict_types=1);

defined('MOODLE_INTERNAL') || die();

require_once __DIR__ . '/../../course/moodleform_mod.php'; // используется для создания форм настроек

class mod_helloworld_mod_form extends moodleform_mod
{
    public function definition()
    {
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('name'), array('size' => '48'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client'); // делает поле обязательным для заполнения

        //-------------------------------------------------------
        $this->standard_coursemodule_elements(); // стандартные настроечки

        //-------------------------------------------------------
        $this->add_action_buttons(); // кнопочки сохранить, отмена и тд.

    }

}
