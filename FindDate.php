<?php

class FindDate {

	/**
	 * @var array
	 * Days of week
	 * Starts from Sunday (key 0)
	 */
	private $_days = array(
		1 => 'Monday',
		2 => 'Tuesday',
		3 => 'Wednesday',
		4 => 'Thursday',
		5 => 'Friday',
		6 => 'Saturday',
		0 => 'Sunday'
		); 
	
	/**
	 * Check for Leap year
	 * @param int $year
	 * @return boolean
	 */	
	public function isLeap($year) {
		if (!isset($year) || $year == NULL) {
			return false;
		}
		else if ($year % 400 == 0) {
			return true;
		}
		else if ($year % 100 == 0) {
			return false;
		}
		else if ($year % 4 == 0) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Calculates the date from given date and month without any checks
	 * @param int $inputYear
	 * @param int $givenMonth
	 * @param int $givenDay
	 * @return int 0 to 6 (array key $_days)
	 */
	public function calculateDateFromGivenOne($inputYear, $givenMonth, $givenDay) {
	
		$tbl1 = (int)$inputYear/4;
		$tbl2 = (int)$inputYear/100;
		$tbl3 = (int)$inputYear/400;

		$newYear = (($inputYear + $tbl1) - $tbl2) + $tbl3;
		$newYear = $newYear + $givenDay + $givenMonth - 1;
		$dayKey = $newYear % 7;
		
		return $dayKey;
	}
	
	/**
	 * Check if the year is leap so changes the remainder
	 * @param int $inputYear
	 * @param int $givenMonth
	 * @param int $givenDay
	 * @return int (value from inner array $_days)
	 */
	public function checkForLeapAndCalculate($inputYear, $givenMonth, $givenDay) {
		
		if ($this->isLeap($inputYear)) {
			return $this->_days[$this->calculateDateFromGivenOne($inputYear, $givenMonth, $givenDay) + 1];
		}
		else {
			return $this->_days[$this->calculateDateFromGivenOne($inputYear, $givenMonth, $givenDay)];
		}
		
	}
	
	/**
	 * Simple constraints - year must be numeric and not null
	 * @param int $year
	 * @return boolean
	 */
	public function constraints($year) {
		if (isset($year) && is_numeric($year) && !is_null($year)) {
			return true;
		}
		else {
			return false;
		}
	}
	
}
?>

<!-- This should be in a new file, but for exercise purpose it's here -->

<?php
	$calendar = new FindDate();
	$month = 3;
	$day = 3;
?>

	<form action="" method="post">
		<input type="text" name="year" />
		<input type="submit" name="submit" value="show" />
	</form>
<?php if (isset($_POST['year']) && $calendar->constraints($_POST['year'])): ?>
	<div> <?= $calendar->checkForLeapAndCalculate($_POST['year'], $month, $day); ?> </div>
<?php endif; ?>
