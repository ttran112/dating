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
require_once ('model/validation.php');


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
$f3 -> route('GET|POST /personal', function ($f3)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


//get post array for first name, last name, age,gender and phone
        $userFirstName = $_POST['fname'];
        $userLastName = $_POST['lname'];
//        $userAge = $_POST['age'];
//        $userGender = $_POST['gender'];
//        $userPhone = $_POST['phone'];

//if first name valid store in session
        if (validName($userFirstName)) {
            $_SESSION['fname'] = $userFirstName;
        }
        else {//not valid firstname
            $f3 -> set('errors["fname"]', "Please enter a name!!");
        }
//if last name valid store in session
        if (validName($userLastName)) {
            $_SESSION['lname'] = $userLastName;
        }
        else {//not valid last name
            $f3 -> set('errors["lname"]', "Please enter a name");
        }

//If there are no errors, redirect to /order2
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile');  //GET
        }


//the name in pudt is not valid

//set the value
//$f3->set('gender', getGender());

        $f3->set('fname', isset($userFirstName) ? $userFirstName : "");
        $f3->set('lname', isset($userLastName) ? $userLastName : "");
//$f3->set('age', isset($userAge) ? $userAge : "");
//$f3->set('gender', isset($userGender) ? $userGender : "");
//$f3->set('phone', isset($userPhone) ? $userPhone : "");

        $view = new Template();
        echo $view->render('views/personalinfo.html');
    }
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