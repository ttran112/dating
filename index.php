<?php
/*
 * Author Thanh Tran
 * description: main page for the viewing dating webpage
 * link: index.php
 */
//Turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//start session
//session_start();

//require the autoload file
require_once ('vendor/autoload.php');
//require_once ('class/Member.php');
//require_once ('class/PremiumMember.php');
//require_once ('model/data-layer.php');
//require_once ('model/DataLayer.php');
//require_once ('model/validation.php');

session_start();


//create an instance of the Base class
$f3 = Base::instance();
$validator = new validation();
$dataLayer = new DataLayer();
$normalMember = new Member("","",0,'',"","","","","");
$premiumMember = new PremiumMember();
$controler = new Controler($f3);
//set a debug
$f3 -> set('DEBUG',3);

// define a default route
    $f3->route('GET /', function () {
        global $controler;
        $controler->home();

    });

//route for personal info
    $f3->route('GET|POST /personal', function () {
        global $controler;
        $controler->personal();
    });

//route for profile
    $f3->route('GET|POST /profile', function () {
        global $controler;
        $controler->profile();
    });
//route for interest
    $f3->route('GET|POST /interest', function () {
        global $controler;
        $controler->interest();

    });
//route for summary
    $f3->route('GET /summary', function () {

        global $controler;
        $controler->summary();
    });

//run fat free
$f3 -> run();