<?php


class Controler
{
    private $_f3;
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Display home page
     */
    function home()
    {
        //Display a view
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * display personal info page
     */
    function personal()
    {
        global $validator;
        global $dataLayer;
        global $normalMember;
        global $premiumMember;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get post array for first name, last name, age,gender and phone

            $userFirstName = $_POST['fname'];
            $userLastName = $_POST['lname'];
            $userAge = $_POST['age'];
            $userGender = $_POST['gender'];
            $userPhone = $_POST['phone'];
            $userChoice = $_POST['memberChoice'];

            //if first name valid store in session
            if ($validator->validName($userFirstName)) {
                $_SESSION['fname'] = $userFirstName;
                $normalMember->setFname($userFirstName);
                $premiumMember->setFname($userFirstName);//added
            }
            else {//not valid firstname
                $this->_f3->set('errors["fname"]', "Please enter a name!! and must be valid");
            }

            //if last name valid store in session
            if ($validator->validName($userLastName)) {
                $_SESSION['lname'] = $userLastName;
                $normalMember->setLname($userLastName);
                $premiumMember->setLname($userLastName);//added

            }
            else {//not valid last name
                $this->_f3->set('errors["lname"]', "Please enter a name!! and name must be valid");
            }

            //if age is valid and in range 18 -118
            if ($validator->validAge($userAge) && $userAge >= 18 && $userAge <= 118) {
                $_SESSION['age'] = $userAge;
                $normalMember->setAge($userAge);
                $premiumMember->setAge($userAge);//added
            } //invalid name or not in range
            else {
                $this->_f3->set('errors["age"]', "Please enter a age (age in range 18-118)");
            }

            //check if gender is slect or not
            if (isset($_POST['gender'])){
                $userGender = $_POST['gender'];

                //if gender is valid store in a session
                if($validator->validGenders($userGender)) {
                    $_SESSION['gender'] = $userGender;
                    $normalMember->setGender($userGender);
                   $premiumMember->setGender($userGender);//added
                }
                //not valid gender
                else {
                    $this->_f3->set('errors["gender"]', "Go away, Evildoer");
                }
            }


            //if valid phone number
            if($validator->validPhone($userPhone)){
                $_SESSION['phone'] = $userPhone;
                $normalMember->setPhone($userPhone);
                $premiumMember->setPhone($userPhone);//added
            }
            //invalid name or not in range
            else {
                $this->_f3->set('errors["phone"]', "Please enter 10 digits phone number");
            }

            //$memberChoice = $_POST['memberChoice'];

            if(isset($_POST['memberChoice']))
            {
                //$memberChoice = new PremiumMember();
                $_SESSION['memberChoice'] = $userChoice;
                $_SESSION['memberChoice'] = new PremiumMember();
            }
            else {
                $_SESSION['memberChoice'] = $userChoice;

//                //$memberChoice = new Member("","",0,"","","","","","");
                $_SESSION['memberChoice'] = new Member("","",0,"","","","","","");

            }

//If there are no errors, redirect to /profile
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['normalMember'] = $normalMember;
                $_SESSION['premiumMember'] = $premiumMember;//added
                $this->_f3->reroute('/profile');
            }
        }

//        var_dump($_SESSION['memberChoice']);

        //set the value
        $this->_f3->set('genders', $dataLayer->getGenders());

        $this->_f3->set('userFirstName', isset($userFirstName) ? $userFirstName : "");
        $this->_f3->set('userLastName', isset($userLastName) ? $userLastName : "");
        $this->_f3->set('userAge', isset($userAge) ? $userAge : "");
        $this->_f3->set('userGender', isset($userGender) ? $userGender : "");
        $this->_f3->set('userPhone', isset($userPhone) ? $userPhone : "");
        $this->_f3->set('userChoice', isset($userChoice) ? $userChoice: "");

        //var_dump($_SESSION['memberChoice']);
        //display a view
        $view = new Template();
        echo $view->render('views/personalinfo.html');
    }

    function profile()
    {
        global $validator;
        global $dataLayer;
        global $normalMember;
        global $premiumMember;
        //set email
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //get data from post array
            $userEmail = $_POST['email'];
            $userBio = $_POST['bio'];
            $userState = $_POST['state'];

            //valid email
            if ($validator->validEmail($userEmail)) {
                $_SESSION['email'] = $userEmail;
                //$normalMember->setEmail($userEmail);
                $_SESSION['normalMember']->setEmail($userEmail);
                $_SESSION['premiumMember']->setEmail($userEmail);//added
            } //not valid email
            else {
                $this->_f3->set('errors["email"]', "Please enter a email and it need to be valid");
            }

            //check if gender is slect or not
            if (isset($_POST['seeking'])) {
                $userSeeking = $_POST['seeking'];

                //if gender is valid store in a session
                if ($validator->validGenders($userSeeking)) {
                    $_SESSION['seeking'] = $userSeeking;
//                    //$normalMember->setSeeking($userSeeking);
                    $_SESSION['normalMember']->setSeeking($userSeeking);
                    $_SESSION['premiumMember']->setSeeking($userSeeking);//added

                } //not valid gender
                else {
                    $this->_f3->set('errors["seeking"]', "Go away, Evildoer");
                }
            }

            //if bio valid store in session
            if (isset($userBio)) {
                $_SESSION['bio'] = $userBio;
//                //$normalMember->setBio($userBio);
                $_SESSION['normalMember']->setBio($userBio);
                $_SESSION['premiumMember']->setBio($userBio);//added

            }
//            else {//not valid firstname
//                $f3->set('errors["bio"]', "Enter a valid bio");
//            }

            if (isset($_POST['state'])){
                $_SESSION['state'] = $userState;
                //$_SESSION['normalMember'] = $normalMember;


//                //$normalMember->setState($userState);
                $_SESSION['normalMember']->setState($userState);
                $_SESSION['premiumMember']->setState($userState);//added

            }

            //If there are no errors, redirect to /profile
            if (empty($this->_f3->get('errors'))) {
                if ($_SESSION['memberChoice'] == new PremiumMember()) {
                    $this->_f3->reroute('/interest');  //GET
                }
                else {
                    $this->_f3->reroute('/summary');  //GET
                }
            }

        }
//        var_dump($_SESSION['memberChoice']);

        //set value for state
        $this->_f3->set('states',$dataLayer->getState());
        $this->_f3->set('seekings', $dataLayer->getGenders());
        $this->_f3->set('userSeeking', isset($userSeeking) ? $userSeeking : "");
        $this->_f3->set('userEmail', isset($userEmail) ? $userEmail : "");
        $this->_f3->set('userBio', isset($userBio) ? $userBio : "");
        $this->_f3->set('userState', isset($userState)? $userState: "");



        //var_dump($_POST);
        $view = new Template();
        echo $view -> render('views/profile.html');
    }

    function interest()
    {
        global $validator;
        global $dataLayer;
//        global $normalMember;
        global $premiumMember;

        //if the form has been submitted
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            //if some or all indoor are checked
            if (isset($_POST['indoors'])){
                $userIndoors = $_POST['indoors'];
                //valid indoor interest values
                if ($validator->validIndoor($userIndoors)){
                    $_SESSION['indoors'] = implode(", ",$userIndoors);
                    //$_SESSION['premiumMember'] = $premiumMember;

                    $indoorString = implode(", ",$userIndoors);
                    //$premiumMember->setInDoorInterests($userIndoors);
                    $_SESSION['premiumMember']->setIndoorInterests($indoorString);
                }
                //not valid indoor interest
                else {
                    $this->_f3->set('errors["indoors"]', "Go away, evildoer!") ;
                }
            }
            //if outdoor interest are selected
            if(isset($_POST['outdoors'])) {
                $userOutdoor = $_POST['outdoors'];
                //if selected value are valid
                if($validator->validOutDoor($userOutdoor)) {
                    $_SESSION['outdoors'] = implode(", ", $userOutdoor);
                    //$premiumMember->setOutDoorInterests($userOutdoor);
                    $outdoorString = implode(", ",$userOutdoor);
                    $_SESSION['premiumMember']->setOutdoorInterests($outdoorString);


                }
                //selected values are not valid
                else {
                    $this->_f3->set('errors["outdoors"]', "Go away, evildoer!");
                }

            }

            //If there are no errors, redirect user to summary page
            if (empty($this->_f3->get('errors'))) {
                //$_SESSION['premiumMember'] = $premiumMember;
                $this->_f3->reroute('/summary');
            }
        }
//        var_dump($_SESSION['memberChoice']);

        //set value for indoor and outdoor
        $this->_f3->set('indoors',$dataLayer->getIndoorInterest());
        $this->_f3->set('outdoors',$dataLayer->getOutdoorInterest());


        $view = new Template();
        echo $view -> render('views/interest.html');
    }

    function summary()
    {

//        var_dump($_SESSION['memberChoice']);


        $view = new Template();
        echo $view->render('views/summary.html');

        if ($_SESSION['memberChoice'] == new PremiumMember()){
            print_r($_SESSION['premiumMember']);
        }
        else {
            print_r($_SESSION['normalMember']);
        }

        //destroy Session
        session_destroy();

    }

}