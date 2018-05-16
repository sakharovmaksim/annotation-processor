<?php
declare(strict_types = 1);
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Concrete class to process the `@user` annotations.
 * Examples:
 * `@user anonymous` to stay not logged in
 * `@user username password`
 *
 */

namespace src\Annotation;

use src\Annotation;

class UserAnnotation extends Annotation
{
	/**
	 * @param	string           $phpDocs
	 * @param	\ReflectionClass $classReflection
	 * @return	mixed
	 * @throws	\Exception
	 */
	protected function _processDocs(string $phpDocs, \ReflectionClass $classReflection)
	{
		$userAnnotation = '@user';
		if (!preg_match("/$userAnnotation" . '\s+(\S+)\s*(\S+)?\s*\n/', $phpDocs, $matches))
		{
			return null;
		}
		$username = $this->_evaluateConstant($matches[1], $classReflection);
		if ($username === 'anonymous')
		{
			$password = null;	// анониму пароль не нужен
		}
		else
		{
			if (isset($matches[2]))
			{
				$password = $this->_evaluateConstant($matches[2], $classReflection);
			}
			else
			{
				throw new \Exception("Password is not set for not anonymous user" );
			}
		}
		return [
			'username' => $username,
			'password' => $password,
		];
	}

	/**
	 * @param mixed $previousResult
	 * @param mixed $newResult
	 * @return array
	 */
	protected function _mergeResult($previousResult, $newResult)
	{
		if (is_null($previousResult))
		{
			return $newResult;
		}

		if (is_null($newResult))
		{
			return $previousResult;
		}

		if (is_array($previousResult) && is_array($newResult))
		{
			return array_merge($previousResult, $newResult);
		}
		return [];
	}
}
