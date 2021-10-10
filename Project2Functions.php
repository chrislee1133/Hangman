<?php

function fetchWord($wordFile) {
	$file = fopen($wordFile, 'r');
	if($file) {
		$random_line = null;
		$line = null;
		$count = 0;
		while(($line = fgets($file)) != false) {
			$count++;
			if(rand()%$count == 0) {
				$random_line = trim($line);
			}
		}
		if(!feof($file)) {
			fclose($file);
			return null;
		}
		else{
			fclose($file);
		}
	}
	$answer = str_split($random_line);
	return $answer;
}

function hideCharacters($answer) {
	$numberOfHidden = floor((sizeof($answer)/2) + 1);
	$count = 0;
	$hidden = $answer;
	while($count < $numberOfHidden) {
		$rand_element = rand(0, sizeof($answer)-2);
		if($hidden[$rand_element] != '_') {
			$hidden = str_replace($hidden[$rand_element], '_', $hidden, $replace_count);
			$count = $count + $replace_count;
		}
	}
	return $hidden;
}

function checkThenReplace($userInput, $hidden, $answer) {
	$value = 0;
	$incorrect = true;
	while($value < count($answer)) {
		if($answer[$value] == $userInput) {
			$hidden[$value] = $userInput;
			$incorrect = false;
		}
		$value = $value + 1;
	}
	if (!$incorrect) $_SESSION['attempts'] = $_SESSION['attempts']-1;
	return $hidden;
}

function checkGameOver($MAX_TRIES, $userTries, $answer, $hidden) {
	if($userTries >= $MAX_TRIES) {
		echo 'Game Over: The correct answer was ';
		foreach($answer as $letter) {
			echo $letter;
		}
		echo '<br><form action="" method="post"><input type="submit" name="newWOrd" value="Try Another Word"></form><br>';
		return true;
		die;
	}
	if($hidden == $answer){
		echo 'Game Over: You guessed the correct word ';
		foreach($answer as $letter) {
			echo $letter;
		}
		echo '<br><form action="" method="post"><input type="submit" name="newWOrd" value="Try Another Word"></form><br>';
		return false;
		die;
	}
}




?>