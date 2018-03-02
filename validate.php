<?php
//checks that the email is of the correct format
function validateEmail(&$errors, $field_list, $field_name) {
	$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
	if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
		$errors[$field_name] = 'This field is required';
	} else if (!preg_match($pattern, $field_list[$field_name])) {
		$errors[$field_name] = ' please enter a valid email address';
	}
}
//checks that all fields are populated. 
function checkEmpty(&$errors, $field_list, $field_name) {
	if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
		$errors[$field_name] = 'This field is required';
	}
}
//checks that the passwords match
function checkMatch(&$errors){
	if ($_POST['password'] != $_POST['passwordConfirm']){
		$errors['passwordConfirm'] = 'Passwords must match';

	}
}
//checks that the postcode contains 4 characters
function checkPostcode(&$errors){
	if (strlen($_POST['postCode']) != 4){
		$errors['postCode'] = 'please enter a valid post code';
	}
	if(!is_numeric($_POST['postCode'])){
		$errors['postCode'] = 'please enter a valid postcode';
	}
}


?>