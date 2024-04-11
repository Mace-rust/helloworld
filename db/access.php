<?php

defined('MOODLE_INTERNAL') || die;

$capabilities = array(
    'mod/helloworld:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE, // разрешение применяется на уровне модуля курса
        'archetypes' => array(
            // гость + пользователь = разрешение на просмотр модуля
            'guest' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        )
    ),

    'mod/helloworld:addinstance' => array(


        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,  // разрешение применяется на уровне курса
        'archetypes' => array(
            //только преподаватели + администраторы = разрешение на добавление новых экземпляров модуля
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities'
    ),

);