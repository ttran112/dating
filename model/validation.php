<?php


function validName($name) {
    return !empty($name) && ctype_alpha($name);
}

function validAge($age) {
    return !empty($age) && is_numeric($age);
}

function validGenders($gender){
    $validGenders = getGenders();
    return in_array($gender, $validGenders);
//    $validGenders = getGenders();
//    foreach ($selectedGender as $selected) {
//        if(!in_array($selected,$validGenders)){
//            return false;
//        }
//    }
//    return true;

}

function validPhone($phone){
    return !empty($phone) && preg_match("/^\d{10}$/",$phone);
}

function validEmail($email){
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

//function validBio($bio){
//    return preg_match("/.{2,60}$/", $bio);
//}

function validIndoor($selectedIndoors) {
    $validIndoors = getIndoorInterest();
    foreach ($selectedIndoors as $selected) {
        if (!in_array($selected,$validIndoors)){
            return false;
        }
    }
    return true;
}

function validOutDoor($selectedOutdoors) {
    $validOutdoors = getOutdoorInterest();
    foreach ($selectedOutdoors as $selected) {
        if (!in_array($selected,$validOutdoors)){
            return false;
        }
    }
    return true;
}



