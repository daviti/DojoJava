<?php

	//Given a postitive integer calculate the sum of the digits
	//optional: do this until the sum is one digit in size
	function sum_to_1($input)
	{
		$string_input = (string)$input;
		while (strlen($string_input) > 1)
		{
			$array = str_split($string_input);
			$sum = array_sum($array);
			$string_input = (string)$sum;
		}
		return $sum;
	}
	echo "sum_to_1: " . sum_to_1(1234567) . "<br />";
	echo "sum_to_1: " . sum_to_1(1999) . "<br />";

	function recursive_sum_to_one($input)
	{
		$sum = 0;
		while ($input)
		{
			$sum += $input % 10;
			$input = floor( $input / 10 );
		}
		if ($sum > 9)
			return recursive_sum_to_one($sum);
		return $sum;
	}
	echo "recursive: " . recursive_sum_to_one(1234567) . "<br />";
	echo "recursive: " . recursive_sum_to_one(1999) . "<br />";

	//Given a target string and a search string, write a function that
	// returns 'true' if the search string is in the target string,
	// 'false' if it is not.
	// (optional): Instead of 'true' or 'false', return the number of times
	// the search string is in the target string.
	function finder($needle, $haystack)
	{
		$count = 0;
		$needle_length = strlen($needle);
		$needle_positions = (strlen($haystack) - $needle_length) + 1;

		for($i = 0; $i < $needle_positions; $i++)
		{
			$word_exists = TRUE;
			for($j = 0; $j < $needle_length; $j++)
			{
				if ($haystack[$i + $j] != $needle[$j])
				{
					$word_exists = FALSE;
				}
			}
			if ($word_exists)
			{
				$count += 1;
			}
		}
		return $count;
	}

	echo finder('I sc', 'I scream, you scream, we all scream for ice cream');
	echo '<br />';
	echo finder('cream, ', 'I scream, you scream, we all scream for ice cream');
	echo '<br />';
	echo finder('kitty', 'I scream, you scream, we all scream for ice cream');
?>