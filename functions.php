<?php
function label($name, $label){
	echo '<label for=$name>';
	echo $label;
	echo'</label>';
	echo '<br>';
}

function posted_value($name){
	if (isset($_POST[$name])){
		return htmlspecialchars($_POST[$name]);
	}
	$emptyValue = "";
	return $emptyValue;
}

function errorLabel($errors, $name){
	$nameError = $name . "Error";
	echo '<br>';
	echo "<span id=\"$nameError\" class=\" error\">";
	if(isset($errors[$name])) echo $errors[$name];
	echo '</span>';


}


function input_field($errors, $name, $label, $type) {
	echo '<div class="required_field">';
	label($name, $label);
	$value = posted_value($name);
	echo "<input type=\"$type\" onkeypress = \"CheckChange('$name')\" id=\"$name\" name=\"$name\" value=\"$value\"/>";
	errorLabel($errors, $name);
	echo '</div>';
}

?>

