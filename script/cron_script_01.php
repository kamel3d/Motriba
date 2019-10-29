#!/usr/bin/php
<?php
set_time_limit(0);
$system_folder = "../system";
$_SERVER['PATH_INFO'] = '/cron/temp_to_stats';
$_GET = ''; // Required for some installations
$_SERVER['REQUEST_URI'] = '/cron/temp_to_stats';