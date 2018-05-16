<?php
declare(strict_types = 1);
/**
 * @author Maksim Sakharov <sakharov@tutu.ru>
 *
 * @description Utils for Api tests
 */

namespace src;

class Utils
{
	/**
	 * @param string $string
	 * @return string
	 */
	public static function stripAllWhiteSpaces(string $string) : string
	{
		$string = preg_replace('/\s+/', '', $string);
		$string = htmlentities($string);
		$string = str_replace('&thinsp;', '', $string);
		return str_replace('&nbsp;', '', $string);
	}
}
