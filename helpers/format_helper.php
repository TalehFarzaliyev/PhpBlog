<?php
	/*
	*	Format The Date
	*/
	function formatDate($date){
		return date('F j, Y, g:i a', strtotime($date));
	}

	/*
	*
	*	Shortened Text
	*/

	function shortenedText($text, $chars = 450){
		$text = $text." ";
		$text = substr($text, 0, $chars); //returns part of the string. 0 is start postition. $chars is length of text
		$text = substr($text, 0, strrpos($text, ' ')); //do not let text get cut off in the middle of a word. //finds the first occurrence of a substring in a string.
		$text = $text."..."; //add elipses.
		return $text;
	}
?>