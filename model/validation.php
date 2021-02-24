<?php


function validName($name) {
    return !empty($name) && ctype_alpha($name);
}

function validAge($age) {
    return !empty($age) && is_numeric($age);
}

//function validGenders($gender){
//    $validGenders = getGender();
//    return in_array($gender, $validGenders);
//}

function validPhone($phone){
    return !empty($phone) &&preg_match("/^\d{10}$/",$phone);
}

function validEmail($email){

}

function validOutDoor($outdoor) {

}

function validIndoor($indoor) {

}

