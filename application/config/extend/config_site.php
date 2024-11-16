<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 4/22/18
 * Time: 18:59
 */
$config['site_author'] = [
    'name' => '',
    'job' => [
        'title' => '',
        'description' => ''
    ],
    'avatar' => [
        'small' => 'https://secure.gravatar.com/avatar/463fc33119b4304b6fc0932ac3f262c3?size=100',
        'large' => 'https://secure.gravatar.com/avatar/463fc33119b4304b6fc0932ac3f262c3?size=500',
    ],
    'url' => '',
    'email' => '',
    'blog' => '',
    'facebook' => '',
    'instagram' => '',
    'twitter' => '',
    'linkedin' => '',
    'github' => '',
    'flickr' => '/',
];
$config['site_data'] = [
    'url' => config_item('base_url'),
    'image' => config_item('base_url') . 'assets/images/image_src.jpg',
    'site_name' => '',
    'title' => '',
    'description' => '',
    'keywords' => '',
    'fb_app_id' => '',
    'fb_admins' => ''
];
$config['tracking_code'] = [
    'google_analytics_id' => ''
];
