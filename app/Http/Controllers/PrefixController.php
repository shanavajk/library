<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrefixController extends Controller
{
    public function getCommonLongestPrefix($array)
	{
		//variable to store common prefix
		$commonPrefix = "";
		//Variable to count no of occurrences of character in all the array values  
		// substr($array[0], 0, $i) gives the common longest prefix
		$i = 0;
		//
		$len = strlen($array[0]);
		
		while($i<$len)
		{
			//Get the $i th character and compare with all the array values
			$str = $array[0][$i];
			for($j=1;$j<count($array);$j++)
			{
				//If a character is not found in the array value then break the loop
				if($str !== $array[$j][$i])
					 break 2; // There are two loops while and for so break 2 will exit out of the both loops		
			}
			$i++;
		}
		//If there's no common prefix in all the array values return -1 else return common prefix
		if($i == 0)
		{
			return -1;
		}
		else
		{
			//Common longest prefix
			return $commonPrefix = substr($array[0], 0, $i);
		}		
    }
    public function index() 
    {
        //Array with common prefix
        $array_common_prefix = Array("Cards", "Cars", "Caffiene", 'Cardio');
        $message1 = "Array values with common prefix : ". $this->getCommonLongestPrefix($array_common_prefix);
        
        //array without common prefix
        $array_no_common_prefix = Array("Boat", "Dog", "Cat");
        $message2 = "Array values without common prefix : ". $this->getCommonLongestPrefix($array_no_common_prefix);

        return view('common_prefix', compact("array_common_prefix","message1","array_no_common_prefix","message2"));
    }
}
