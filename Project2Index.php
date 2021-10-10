<!DOCTYPE html>
<?php session_start();?>
<html>
   <head>
      <title>Hangman Game</title>
      <link href="./HangmanStylesheet.css" rel="stylesheet" type="text/css">

   </head>
   <body>
   <!-- animation container -->
<div class="eye-animation"></div>
   
   
		<?php
		require 'Project2config.php';
		require 'Project2Functions.php';
		if(isset($_POST['newWord'])) unset($_SESSION['answer']);
		if(!isset($_SESSION['answer'])) {
			$_SESSION['attempts'] = 0;
			$answer = fetchWord($WORDSFILE);
			$_SESSION['answer'] = $answer;
			$_SESSION['hidden'] = hideCharacters($answer);
			echo 'Attempts Remaining: '.($MAX_TRIES-$_SESSION['attempts']).'<br>';
		}
		else {
			if(isset($_POST['userInput'])) {
				$userInput = $_POST['userInput'];
				$_SESSION['hidden'] = checkThenReplace(strtolower($userInput), $_SESSION['hidden'], $_SESSION['answer']);
				checkGameOver($MAX_TRIES, $_SESSION['attempts'], $_SESSION['answer'], $_SESSION['hidden']);
			}
			$_SESSION['attempts'] = $_SESSION['attempts']+1;
			echo 'Attempts Remaining: '.($MAX_TRIES-$_SESSION['attempts']).'<br>';
		}
		$hidden = $_SESSION['hidden'];
		foreach($hidden as $char) echo $char." ";
		

		?>
		
		
		<form name="Info" action="" method="post">
               <label>Name</label>
               <input type="text" name="name" class="textbox" autofocus required
                      placeholder="Name" title="Name" maxlength="50" pattern="[A-Za-z'-]{2,20}" />
       
               <label></label>
               <button type="submit">Submit form</button>
        </form>
		
		<form name="inputForm" action="" method="post">
		Your Guess: <input name="userInput" type="text" size="1" maxlength="1">
		<input type="submit" value="Check" onclick="return validateInput();">
		<input type="submit" value="Try Another Word" name="newWord">
		</form>
		
	</body>
</html>