<?php
declare(strict_types=1);
global $CFG;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php'); // используется для создания форм настроек
require_once($CFG->libdir.'/filelib.php'); // функции для работы с файлами Moodle

class mod_helloworld_mod_form extends moodleform_mod {

    public function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('name'), array('size'=>'48'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client'); // делает поле обязательным для заполнения

        //-------------------------------------------------------
        $this->standard_coursemodule_elements(); // стандартные настроечки

        //-------------------------------------------------------
        $this->add_action_buttons(); // кнопочки сохранить, отмена и тд.

    }
//    public function data_preprocessing(&$defaultvalues) {
//        if ($this->current->instance) {
//            $draftitemid = file_get_submitted_draft_itemid('helloworld');
//            $defaultvalues['helloworld']['format'] = $defaultvalues['contentformat'];
//            $defaultvalues['helloworld']['text']   = file_prepare_draft_area($draftitemid, $this->context->id, 'mod_helloworld',
//                'content', 0, page_get_editor_options($this->context), $defaultvalues['content']); // функция из локаллиба page
//            $defaultvalues['helloworld']['itemid'] = $draftitemid;
//        }
//        if (!empty($defaultvalues['displayoptions'])) {
//            $displayoptions = (array) unserialize_array($defaultvalues['displayoptions']);
//            if (isset($displayoptions['printintro'])) {
//                $defaultvalues['printintro'] = $displayoptions['printintro'];
//            }
//            if (isset($displayoptions['printheading'])) {
//                $defaultvalues['printheading'] = $displayoptions['printheading'];
//            }
//            if (isset($displayoptions['printlastmodified'])) {
//                $defaultvalues['printlastmodified'] = $displayoptions['printlastmodified'];
//            }
//            if (!empty($displayoptions['popupwidth'])) {
//                $defaultvalues['popupwidth'] = $displayoptions['popupwidth'];
//            }
//            if (!empty($displayoptions['popupheight'])) {
//                $defaultvalues['popupheight'] = $displayoptions['popupheight'];
//            }
//        }
//    }
}
