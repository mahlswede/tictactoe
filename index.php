<?php
require_once('classes/game.php');
require_once('classes/tictactoe.php');

// start the session
session_start();

// if the game isn't started, load the game
if (!isset($_SESSION['game']['tictactoe']))
	$_SESSION['game']['tictactoe'] = new tictactoe();

?>
<html>
	<head>
		<title>Tic Tac Toe</title>
        <link rel="stylesheet" type="text/css" href="public/styles/foundation.css" />
        <link rel="stylesheet" type="text/css" href="public/styles/style.css" />
	</head>
	<body>
		<div id="content">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<h2>Tic Tac Toe</h2>
		<?php
			$_SESSION['game']['tictactoe']->playGame($_POST);
		?>
		</form>
		</div>
	</body>
</html>