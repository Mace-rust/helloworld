<?php
declare(strict_types=1);

namespace mod_helloworld\privacy;

defined('MOODLE_INTERNAL') || die();

class provider implements \core_privacy\local\request\provider
{

    public static function get_reason(): string
    {
        return 'Plugin requires some user data to display greeting message.';
    }

    public static function get_contexts(): array
    {
        return [\context_system::instance()];
    }

    public static function export_user_data(\core_privacy\local\request\writer $writer, \core_privacy\local\request\user_preference $preference): void
    {
        //
    }

    public static function delete_data_for_user(\core_privacy\local\request\user_preference $preference): bool
    {
        return true;
    }
}
