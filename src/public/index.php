<?php 

use Aslam\Test\public\Request;
use Aslam\Test\public\App;
use Aslam\Test\public\Session;

require_once '../../vendor/autoload.php';
require_once 'Session.php';
$session = new Session;
$request = new Request;
define('base_app', str_replace('\\','/',__DIR__).'/' );
define('base_url', 'http://localhost/myPracticing/Sun_Project/src/public/index.php?');
$app = new App($request);
