<?php
declare(strict_types = 1);
/**
 * @author Nina Belan <nbelan@tutu.ru>
 *
 * @description Utils for Api tests
 */

namespace Core;

class Utils
{
	public static function getDate(string $modify, string $format = null, string $dateString = null) : string
	{
		$format = $format ?: 'Y-m-d';
		$date = new \DateTime($dateString ?: date('d.m.Y'));
		$date->modify($modify);
		return $date->format($format);
	}

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

	public static function getCallerTestPath() : string
	{
		$callers = debug_backtrace();
		foreach ($callers as $call)
		{
			// Все тесты начинаются со слова test...
			if (preg_match_all('/^test/u', $call['function'], $matches) > 0)
			{
				return "Тест: " . $call['class'] . '::' . $call['function'] . "\n";
			}
		}
		foreach ($callers as $call)
		{
			// Все тестовые классы лежат в папке Tests...
			if (preg_match_all('/Tests/u', $call['class'], $matches) > 0)
			{
				return "Метод: " . $call['class'] . '::' . $call['function'] . "\n";
			}
		}
		return '';
	}
}
