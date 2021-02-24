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
});

//route for personal info
$f3 -> route('GET|POST /personal', function ($f3)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        //get post array for first name, last name, age,gender and phone
        $userFirstName = trim($_POST['fname']);
        $userLastName = trim($_POST['lname']);
        $userAge = $_POST['age'];
        //$userGender = $_POST['gender'];
        $userPhone = $_POST['phone'];

        //if first name valid store in session
        if (validName($userFirstName)) {
            $_SESSION['fname'] = $userFirstName;
        } else {//not valid firstname
            $f3->set('errors["fname"]', "Please enter a name!! and must be valid");
        }

        //if last name valid store in session
        if (validName($userLastName)) {
            $_SESSION['lname'] = $userLastName;
        } else {//not valid last name
            $f3->set('errors["lname"]', "Please enter a name!! and name must be valid");
        }

        //if age is valid and in range 18 -118
        if (validAge($userAge) && $userAge >= 18 && $userAge <= 118) {
            $_SESSION['age'] = $userAge;
        } //invalid name or not in range
        else {
            $f3->set('errors["age"]', "Please enter a age (age in range 18-118)");
        }

        //check if gender is slect or not
        if (isset($_POST['gender'])){
            $userGender = $_POST['gender'];

            //if gender is valid store in a session
            if(validGenders($userGender)) {
                $_SESSION['gender'] = $userGender;
            }
            //not valid gender
            else {
                $f3->set('errors["gender"]', "Go away, Evildoer");
            }
        }


        //if valid phone number
        if(validPhone($userPhone)){
            $_SESSION['phone'] = $userPhone;
        } //invalid name or not in range
        else {
            $f3->set('errors["phone"]', "Please enter 10 digits phone number");
        }


//If there are no errors, redirect to /profile
        if (empty($f3->get('errors'))) {
            $f3->reroute('/profile');  //GET
        }
    }

       //set the value
        $f3->set('genders', getGenders());

        $f3->set('userFirstName', isset($userFirstName) ? $userFirstName : "");
        $f3->set('userLastName', isset($userLastName) ? $userLastName : "");
        $f3->set('userAge', isset($userAge) ? $userAge : "");
        $f3->set('userGender', isset($userGender) ? $userGender : "");
        $f3->set('userPhone', isset($userPhone) ? $userPhone : "");
//    if(isset($_POST['gender'])) {
//        $_SESSION['gender'] = $_POST['gender'];
//    }

        //display a view
        $view = new Template();
        echo $view->render('views/personalinfo.html');

});
//route for profile
$f3 -> route('GET|POST /profile', function ($f3)
{

    //set email
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //get data from post array
        $userEmail = $_POST['email'];
        $userBio = $_POST['bio'];
        $userState = $_POST['state'];

        //valid email
        if (validEmail($userEmail)) {
            $_SESSION['email'] = $userEmail;
        } //not valid email
        else {
            $f3->set('errors["email"]', "Please enter a email and it need to be valid");
        }

        //check if gender is slect or not
        if (isset($_POST['seeking'])) {
            $userSeeking = $_POST['seeking'];

            //if gender is valid store in a session
            if (validGenders($userSeeking)) {
                $_SESSION['seeking'] = $userSeeking;
            } //not valid gender
            else {
                $f3->set('errors["seeking"]', "Go away, Evildoer");
            }

            //if bio valid store in session
            if (validBio($userBio)) {
                $_SESSION['bio'] = $userBio;
            } else {//not valid firstname
                $f3->set('errors["bio"]', "Enter a valid bio");
            }

            if (isset($_POST['state'])){
                $_SESSION['state'] = $userState;
            }

            //If there are no errors, redirect to /profile
            if (empty($f3->get('errors'))) {
                $f3->reroute('/interest');  //GET
            }
        }
    }
    //set value for state
    $f3->set('states',getState());
    $f3->set('seekings', getGenders());
    $f3->set('userSeeking', isset($userSeeking) ? $userSeeking : "");
    $f3->set('userEmail', isset($userEmail) ? $userEmail : "");
    $f3->set('userBio', isset($userBio) ? $userBio : "");
    $f3->set('userState', isset($userState)? $userState: "");



    //var_dump($_POST);
    $view = new Template();
    echo $view -> render('views/profile.html');
}
);
//route for interest
$f3 -> route('GET|POST /interest', function ($f3)
{
    //if the form has been submitted
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        //if some or all indoor are checked
        if (isset($_POST['indoors'])){
            $userIndoors = $_POST['indoors'];
            //valid indoor interest values
            if (validIndoor($userIndoors)){
                $_SESSION['indoors'] = implode(", ",$userIndoors);
            }
            //not valid indoor interest
            else {
                $f3->set('errors["indoors"]', "Go away, evildoer!") ;
            }
        }
        //if outdoor interest are selected
        if(isset($_POST['outdoors'])) {
            $userOutdoor = $_POST['outdoors'];
            //if selected value are valid
            if(validOutDoor($userOutdoor)) {
                $_SESSION['outdoors'] = implode(", ", $userOutdoor);
            }
            //selected values are not valid
            else {
                $f3->set('errors["outdoors"]', "Go away, evildoer!");
            }

        }

        //If there are no errors, redirect user to summary page
        if (empty($f3->get('errors'))) {
            $f3->reroute('/summary');
        }
    }
        //set value for indoor and outdoor
    $f3->set('indoors',getIndoorInterest());
    $f3->set('outdoors',getOutdoorInterest());


    $view = new Template();
    echo $view -> render('views/interest.html');
});
//route for summary
$f3 -> route('GET|POST /summary', function ()
{
    //get post array for indoor and out door interest
//    if(isset($_POST['indoors'])) {
//        $_SESSION['indoors'] = implode(", ",$_POST['indoors']);
//    }
//    if(isset($_POST['outdoors'])) {
//        $_SESSION['outdoors'] = implode(", ", $_POST['outdoors']);
//    }
    //var_dump($_POST);
    $view = new Template();
    echo $view -> render('views/summary.html');
    session_destroy();
}
);
//run fat free
$f3 -> run();