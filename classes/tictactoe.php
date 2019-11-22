<?php

/**
 * Class Tictactoe
 */
class Tictactoe extends Game
{
    // Player whose turn it is (string)
	var $player = "X";
    // Tic tac toe game board (array)
	var $gameBoard = array();
    // Number of moves (int)
	var $totalMoves = 0;

	/**
	 * Constructor
	 */
	function tictactoe()
	{
		// instantiate the game class
		game::start();
		// instantiate game boarc
        $this->newGameBoard();
	}

	/**
	 * Start a new tic tac toe game
	 */
	function newGame()
	{
		// setup the game
		$this->start();

		// reset the player
		$this->player = "X";
		$this->totalMoves = 0;
        $this->newGameBoard();
	}

    /**
	 * Create an empty game board
	 */
    function newGameBoard() {

        // clear out the game board
		$this->gameBoard = array();

        // create the game board
        for ($x = 0; $x <= 2; $x++)
        {
            for ($y = 0; $y <= 2; $y++)
            {
                $this->gameBoard[$x][$y] = null;
            }
        }
    }

	/**
	 * Run the game until it is tied or someone has won
     * @param array $gamedata
	 */
	function playGame($gamedata)
	{
		if (!$this->isGameOver() && isset($gamedata['move'])) {
			$this->move($gamedata);
        }

		// player pressed the button to start a new game
		if (isset($gamedata['newgame'])) {
			$this->newGame();
        }

		// display the game
		$this->displayGame();
	}

	/**
	 * Display the game interface
	 */
	function displayGame()
	{

		// while the game isn't over
		if (!$this->isGameOver())
		{
			echo "<div id=\"gameBoard\">";

			for ($x = 0; $x < 3; $x++)
			{
				for ($y = 0; $y < 3; $y++)
				{
					echo "<div class=\"gameBoard_cell\">";

					// check to see if that position is already filled
					if ($this->gameBoard[$x][$y])
						echo "<img src=\"public/images/{$this->gameBoard[$x][$y]}.jpg\" alt=\"{$this->gameBoard[$x][$y]}\" title=\"{$this->gameBoard[$x][$y]}\" />";
					else
					{
						// let them choose to put an x or o there
						echo "<select name=\"{$x}_{$y}\">
								<option value=\"\"></option>
								<option value=\"{$this->player}\">{$this->player}</option>
							</select>";
					}

					echo "</div>";
				}
			}

			echo "
				<div align=\"center\">
				    <button type=\"submit\" name=\"move\" class=\"button expanded\">Bestätigen</button>
					<h3>Player {$this->player}!<br/>Dein Zug!</h3>
				</div>
			</div>";
		}
		else
		{
			// someone won the game or there was a tie
			if ($this->isGameOver() != "Tie")
				echo successMsg("Glückwunsch Player " . $this->isGameOver() . "! Du hast das Spiel gewonnen!");
			else if ($this->isGameOver() == "Tie")
				echo errorMsg("Oooops! Das sieht nach einem Unentschieden aus. Noch einmal starten?");

			session_destroy();

			echo "<p align=\"center\">
                    <button type=\"submit\" name=\"newgame\" value=\"New Game\" class=\"button\">Neues Spiel</button>
                  </p>";
		}
	}

	/**
	 * Trying to place an X or O on the game board
     * @param array $gamedata
	 */
	function move($gamedata)
	{

		if ($this->isGameOver())
			return;

		// remove duplicate entries on the game board
		$gamedata = array_unique($gamedata);

		foreach ($gamedata as $key => $value)
		{
			if ($value == $this->player)
			{
				// update the game board in that position with the player's X or O
				$coords = explode("_", $key);
				$this->gameBoard[$coords[0]][$coords[1]] = $this->player;

				// change the turn to the next player
				if ($this->player == "X")
					$this->player = "O";
				else
					$this->player = "X";

				$this->totalMoves++;
			}
		}

		if ($this->isGameOver())
			return;
	}

	/**
	 * Check for a winner
	 * @return array|string
	 */
	function isGameOver()
	{
		// top row
		if ($this->gameBoard[0][0] && $this->gameBoard[0][0] == $this->gameBoard[0][1] && $this->gameBoard[0][1] == $this->gameBoard[0][2])
			return $this->gameBoard[0][0];

		// middle row
		if ($this->gameBoard[1][0] && $this->gameBoard[1][0] == $this->gameBoard[1][1] && $this->gameBoard[1][1] == $this->gameBoard[1][2])
			return $this->gameBoard[1][0];

		// bottom row
		if ($this->gameBoard[2][0] && $this->gameBoard[2][0] == $this->gameBoard[2][1] && $this->gameBoard[2][1] == $this->gameBoard[2][2])
			return $this->gameBoard[2][0];

		// first column
		if ($this->gameBoard[0][0] && $this->gameBoard[0][0] == $this->gameBoard[1][0] && $this->gameBoard[1][0] == $this->gameBoard[2][0])
			return $this->gameBoard[0][0];

		// second column
		if ($this->gameBoard[0][1] && $this->gameBoard[0][1] == $this->gameBoard[1][1] && $this->gameBoard[1][1] == $this->gameBoard[2][1])
			return $this->gameBoard[0][1];

		// third column
		if ($this->gameBoard[0][2] && $this->gameBoard[0][2] == $this->gameBoard[1][2] && $this->gameBoard[1][2] == $this->gameBoard[2][2])
			return $this->gameBoard[0][2];

		// diagonal 1
		if ($this->gameBoard[0][0] && $this->gameBoard[0][0] == $this->gameBoard[1][1] && $this->gameBoard[1][1] == $this->gameBoard[2][2])
			return $this->gameBoard[0][0];

		// diagonal 2
		if ($this->gameBoard[0][2] && $this->gameBoard[0][2] == $this->gameBoard[1][1] && $this->gameBoard[1][1] == $this->gameBoard[2][0])
			return $this->gameBoard[0][2];

		if ($this->totalMoves >= 9)
			return "Tie";
	}
}