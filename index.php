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
session_start();

//require the autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');


//create an instance of the Base class
$f3 = Base::instance();
//set a debug
$f3 -> set('DEBUG',3);


// define a default route
$f3 -> route('GET|POST /', function ()
{
    $view = new Template();
    echo $view -> render('views/home.html');
}
);
//route for personal info
$f3 -> route('GET|POST /personal', function ()
{

    $view = new Template();
    echo $view -> render('views/personalinfo.html');
}
);
//route for profile
$f3 -> route('GET|POST /profile', function ($f3)
{
    //set value for state
    $f3->set('states',getState());

    //get post array for fname lname age gender phone
    if(isset($_POST['fname'])) {
        $_SESSION['fname'] = $_POST['fname'];
    }
    if(isset($_POST['lname'])) {
        $_SESSION['lname'] = $_POST['lanme'];
    }
    if(isset($_POST['age'])) {
        $_SESSION['age'] = $_POST['age'];
    }
    if(isset($_POST['gender'])) {
        $_SESSION['gender'] = $_POST['gender'];
    }
    if(isset($_POST['phone'])) {
        $_SESSION['phone'] = $_POST['phone'];
    }


    //var_dump($_POST);
    $view = new Template();
    echo $view -> render('views/profile.html');
}
);
//route for interest
$f3 -> route('GET|POST /interest', function ($f3)
{
    //set value for indoor and outdoor
    $f3->set('indoors',getIndoorInterest());
    $f3->set('outdoors',getOutdoorInterest());

    //get post array for email state seeking and bio
    if(isset($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
    }
    if(isset($_POST['state'])) {
        $_SESSION['state'] = $_POST['state'];
    }
    if(isset($_POST['seeking'])) {
        $_SESSION['seeking'] = $_POST['seeking'];
    }
    if(isset($_POST['bio'])) {
        $_SESSION['bio'] = $_POST['bio'];
    }
    //var_dump($_POST);
    $view = new Template();
    echo $view -> render('views/interest.html');
}
);
//route for summary
$f3 -> route('GET|POST /summary', function ()
{
    //get post array for indoor and out door interest
    if(isset($_POST['indoors'])) {
        $_SESSION['indoors'] = implode(", ",$_POST['indoors']);
    }
    if(isset($_POST['outdoors'])) {
        $_SESSION['outdoors'] = implode(", ", $_POST['outdoors']);
    }
    //var_dump($_POST);
    $view = new Template();
    echo $view -> render('views/summary.html');
}
);
//run fat free
$f3 -> run();
