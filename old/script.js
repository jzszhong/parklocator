function reviewValidation() {
	var valid;
	var comment = document.getElementsByName("comment")[0];
	var rate = document.getElementsByName("rate")[0];
	
	if (comment.value == "") {
		window.alert("You cannot send an empty review!");
		valid = false;
	}
	else if (rate.value == "") {
		window.alert("You have to give a rating!");
		valid = false;
	}
	else valid = true;
	
	return valid;
}


//the following functions check the validity of each field
function checkFirstName(form){
//if the field is empty, make the error message visible and return false
		if (form.firstName.value == ""){
			span = document.getElementById("firstNameError");
			txt = document.createTextNode("This field is required");
			span.innerText = txt.textContent;
			return false;
		}
		return true;	
}
function checkLastName(form){
	
		if (form.lastName.value == ""){
			span = document.getElementById("lastNameError");
			txt = document.createTextNode("This field is required");
			span.innerText = txt.textContent;
			return false;
		}
		return true;
}
function checkUsername(form){
	
		if (form.username.value == ""){
			span = document.getElementById("usernameError");
			txt = document.createTextNode("This field is required");
			span.innerText = txt.textContent;
			return false;
		}
		return true;
}

function checkEmail(form){
	var x = form.email.value;
	var atpos = x.indexOf("@");
	//checks if an @ symbol is present in the email address, and that it isnt the first character if it is present
	if (atpos<1){
			span = document.getElementById("emailError");
			txt = document.createTextNode("Please enter a valid email");
			span.innerText = txt.textContent;
		return false;
	}
	return true;
		
}	
function checkPassword(form){
	
		if (form.password.value == ""){
			span = document.getElementById("passwordError");
			txt = document.createTextNode("This field is required");
			span.innerText = txt.textContent;
			return false;
		}
		return true;
}

function checkPasswordConfirm(form){
	
		if (form.passwordConfirm.value == ""){
			span = document.getElementById("passwordConfirmError");
			txt = document.createTextNode("This field is required");
			span.innerText = txt.textContent;
			return false;
		}
		return true;
}

function checkPasswordMatch(form){
//checks if the passwords match, sends an alert to the browser if they don't
		if (form.password.value != form.passwordConfirm.value){
			window.alert("passwords must match");
			return false;
		}
		return true;
}

function checkDateofBirth(form){
	
		if (form.dateofBirth.value == ""){
			span = document.getElementById("dateofBirthError");
			txt = document.createTextNode("This field is required");
			span.innerText = txt.textContent;
			return false;
		}
		return true;
}
//determines if a entered value is a number
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
  //isNaN (Not a number) checks if a value is a number or not. Returns true if Not a number, so use ! to invert (return true if is a number)
  //parseFloat is used to parse a string and return a float
  //is finite checks if a value is a finite number-makes the function more robust
}

function checkPostcode(form){
		var v = true
		//checks if the postcode has 4 characters
		if (form.postCode.value.length < 4){
			span = document.getElementById("postCodeError");
			txt = document.createTextNode("Please enter a valid postcode");
			span.innerText = txt.textContent;
			v = false;
		}
		//checks if the postcode entered is a number
		if (isNumber(form.postCode.value) == false){
			span = document.getElementById("postCodeError");
			txt = document.createTextNode("Please enter a valid postcode");
			span.innerText = txt.textContent;
			v = false;
		}
		return v;
}

function checkCheckBox() {
	var box = document.getElementsByName("Privacy")[0];
	
	if (!box.checked) {
		window.alert("Terms and conditions must be agreed to register");
		return false;
	}
	else return true;
}




// this function takes a field name as its input, and is executed when each field is changed. It is used to hide the error messages.

function CheckChange(field){
		document.getElementById(field + "Error").style.visibility = "hidden";


}





//calls all of the above listed functions. If any of the individual checks fails, the variable is set to false. However, all other fields are also checked regardless of if one has failed.
function RegValidateForm(form) {
		var valid = true;
		//declares a variable to hold the status of the form (true or false) This way if one check fails, the variable is set to false, however all checks are still carried out
		
		if (checkFirstName(form) == false){
			valid = false;
		}
		if (checkPasswordMatch(form) == false){
			valid = false;
		}
		if (checkLastName(form) == false){
			valid = false;
		}	
		if (checkEmail(form) == false){
			valid = false;
		}
		if (checkUsername(form) == false){
			valid = false;
		}
		
		if(checkPassword(form) == false){
			valid = false;
		}
		
		if(checkPasswordConfirm(form) == false){
			valid = false;
		}
		
		if(checkDateofBirth(form) == false){
			valid = false;
		}
		
		if(checkPostcode(form) == false){
			valid = false;
		}
		
		if (!valid) window.alert("Please fill in all required contents!");
		else {
			if (checkCheckBox() == false) valid = false;
		}
		
		return valid;
}