<?php
/*
 * Class Game
 */
class Game {

    // Player's power (int)
	var $power;
    // Toggle game over (bool)
	var $gameover;
    // Player's score (int)
	var $score;
    // Toggle game won (bool)
    var $won;

    /**
     * Setup game environment variables
     */
	function start()
	{
		$this->score = 0;
		$this->power = 100;
		$this->gameover = false;
		$this->won = false;
	}
	
	/**
	 * End the game
	 */
	function end()
	{
		$this->gameover = true;
	}
	
	/**
	 * Change or retrieve the player's score
	 * @param int|null $amount
     * @return int returns the player's updated score
     */
	function setScore($amount = 0)
	{
		return $this->score += $amount;
	}
	
	/**
	 * Change or retrieve the player's power
	 * @param int|null $amount
	 * @return int returns the player's updated score
	 */
	function setPower($amount = 0)
	{			
		return ceil($this->power += $amount);
	}
	
	/**
	* Returns value whether the game is over or not
	* @return bool
	**/
	function isGameOver()
	{
		if ($this->won)
			return true;
			
		if ($this->gameover)
			return true;
			
		if ($this->power < 0)
			return true;
			
		return false;
	}
}

// end of game class

/**
 * Return a formatted error message
 * @param string $msg
 * @return string
 */
function errorMsg($msg)
{
	return "<div class=\"errorMsg\">$msg</div>";
}

/**
 * Return a formatted success message
 * @param string $msg
 * @return string
 */
function successMsg($msg)
{
	return "<div class=\"successMsg\">$msg</div>";
}