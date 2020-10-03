<!DOCTYPE html>
<html>
<head>
	<title>Password strenth</title>
</head>
<body bgcolor="lightblue">
<h1><p align="center"><font color="red">Check your Password at PasswordChecker.com</font></p></h1>
<hr>
<br>
<br>
<form action="script.php" method="post">
	Test your password here: <input type="text" name="password">
	<p><input type="submit"></p>
</form>
<?php
	error_reporting(0);
	$password = $_POST["password"];
	if (strlen($password) > 0){
		$flag_succession = 0;
		$flag_specialChar = 0;
		$flag_cases_lower = 0;
		$flag_cases_upper = 0;
		$positiveMarks = 0;
		function checkCommonExistence(){
			error_reporting(0);
			GLOBAL $positiveMarks;
			$password = $_POST["password"];
			$availData = file_get_contents("password_list.txt");
			if (stripos($availData, $password) !== false){
				echo ("<p>Common password existence test: ❌</p>");
			}
			else {
				echo ("<p>Common password existence test: ✅</p>");
				$positiveMarks++;
			}
		}
		function checkPasswordLength(){
			error_reporting(0);
			GLOBAL $positiveMarks;
			$password = $_POST["password"];
			$lengthOfString = strlen($password);
			if ($lengthOfString <= 8){
				echo "Password length test: ❌";
			}
			else {
				echo "Password length test: ✅";
				$positiveMarks++;
			}
		}
		function checkPasswordNumberSuccession(){
			error_reporting(0);
			GLOBAL $positiveMarks;
			$password = $_POST["password"];
			$password = strval($password);
			$common_sucessions = array("12345", "1234", "123456", "09876", "109876", "123");
			foreach ($common_sucessions as $cmn){
				if (strpos($password, $cmn) !== false){
					GLOBAL $flag_succession;
					$flag_succession = 1;
				}
			}
			
		}
		function checkSpecialCharacters (){
			error_reporting(0);
			GLOBAL $positiveMarks;
			$password = $_POST["password"];
			$password = strval($password);
			$special_characters = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "{", "}", "[", "]", "|", "_", "/", ",", "<", ">", ":", ";", "=", "+", "'", "~", "`");
			foreach ($special_characters as $spchar){
				if (strpos($password, $spchar) !== false){
					GLOBAL $flag_specialChar;
					$flag_specialChar = 1;
				}
			}
			if ($flag_specialChar == 1){
				$positiveMarks++;
			}
		}
		function checkUpLowCase(){
			error_reporting(0);
			GLOBAL $positiveMarks;
			$allLowercase = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
			$allUppercase = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
			$password = $_POST["password"];
			$password = strval($password);
			foreach ($allLowercase as $lowercase){
				if (strpos($password, $lowercase) !== false){
					GLOBAL $flag_cases_lower;
					$flag_cases_lower = 1;
				}
			}
			foreach ($allUppercase as $uppercase) {
				if (strpos($password, $uppercase) !== false){
					GLOBAL $flag_cases_upper;
					$flag_cases_upper = 1;
				}
			}
			if ($flag_cases_lower == 1 and $flag_cases_upper == 1){
				$positiveMarks++;
			}
		}
		function giveFinalResult() {
			GLOBAL $positiveMarks;
			error_reporting(0);
			$password = $_POST["password"];
			$maxMarks = 5;
			echo "<hr>";
			echo "<p>Your entered password: $password</p>";
			echo "<p>Your password strenth is $positiveMarks / $maxMarks</p>";

		}
		checkCommonExistence();
		checkPasswordLength();
		checkPasswordNumberSuccession();
		if ($flag_succession > 0) {
			echo ("<p>Password common numbers test: ❌");
		}
		else {
			$positiveMarks++;
			echo ("<p>Password common numbers test: ✅");
		}
		checkSpecialCharacters();
		if ($flag_specialChar > 0) {
			echo ("<p>Password special characters test: ✅");
		}
		else {
			echo ("<p>Password special characters test: ❌</p>");
		}
		checkUpLowCase();
		if ($flag_cases_lower > 0 and $flag_cases_upper > 0) {
			echo ("<p>Password lower and upper case test: ✅");
		}
		else {
			echo ("<p>Password lower and upper case test: ❌</p>");
		}
		giveFinalResult();
	}
?>
</body>
</html>