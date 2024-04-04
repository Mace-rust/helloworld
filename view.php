<?php
declare(strict_types=1);

defined('MOODLE_INTERNAL') || die();

class mod_helloworld_renderer extends plugin_renderer_base {

    public function render_page() {
        $output = '';
        $output .= html_writer::start_tag('div', ['class' => 'helloworld']);
        $output .= get_string('helloworld', 'helloworld');
        $output .= html_writer::end_tag('div');
        return $output;
    }
}
