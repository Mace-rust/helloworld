<?php
declare(strict_types=1);

global $PAGE, $OUTPUT;
require_once(__DIR__ . '/../../config.php');

// удостовериться, что пользователь залогинился (не обязательно)
require_login();

$PAGE->set_url('/mod/helloworld/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'mod_helloworld'));
$PAGE->set_heading(get_string('pluginname', 'mod_helloworld'));

echo $OUTPUT->header();

echo '<div>Hello World!</div>';

echo $OUTPUT->footer();


//class mod_helloworld extends mod_base {
//    public function init() {
//        $this->title = get_string('pluginname', 'mod_helloworld');
//    }
//
//    public function get_content() {
//        if ($this->content !== null) {
//            return $this->content;
//        }
//
//        $this->content = new stdClass();
//        $this->content->text = '<img src="'.$this->get_helloworld_image().'" /><p>'.get_string('helloworld', 'mod_helloworld').'</p>';
//        return $this->content;
//    }
//
//    private function get_helloworld_image() {
//        return $this->output->pix_url('helloworld', 'mod_helloworld');
//    }
//}


//require_once('../../config.php');
//
//$id = required_param('id', PARAM_INT);
//$PAGE->set_url('/mod/helloworld/index.php', ['id' => $id]);
//require_course_login($id);
//$context = context_module::instance($id);
//$PAGE->set_context($context);
//
//$modid = $id;  // ID модуля
//
//$PAGE->set_pagelayout('incourse');
//$PAGE->set_title('Hello World');
//$PAGE->set_heading('Hello World');
//echo $OUTPUT->header();
//
//require_once('view.php');
//
//echo $OUTPUT->footer();
