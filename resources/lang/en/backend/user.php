<?php
/**
 * Created by PhpStorm.
 * User: Doni
 * Date: 09/19/2017
 * Time: 02:48 PM
 */
return [
    'module' => 'Manajemen User',

    'index' => [
        'title'    => 'List of users (:total)',
        'is_empty' => 'No users registered',
    ],

    'create' => [
        'title' => 'Create users',
    ],

    'gravatar' => [
        'title'       => 'Gravatar',
        'description' => 'Your Gravatar is an image that follows you from site to site appearing beside your name when you do things like comment or post on a blog. Avatars help identify your posts on blogs and web forums, so why not on any site?',
        'button'      => 'Create your gravatar',
    ],

    'store' => [
        'messages' => [
            'success' => 'The user has been successfully created!',
        ],
    ],

    'edit' => [
        'title' => 'Edit users',
    ],

    'update' => [
        'messages' => [
            'success' => 'The user has been successfully updated!',
        ],
    ],

    'destroy' => [
        'messages' => [
            'info'    => 'No user was selected.',
            'warning' => 'You can not delete your own user!',
            'success' => 'The successfully removed users!',
        ],
    ],

    'tables' => [
        'created_at' => 'Dibuat',
        'name'       => 'Nama',
        'username'     => 'Username',
        'email'        => 'Email',
        'bagian_id'        => 'Bagian',
        'password'        => 'Password',
    ],

];