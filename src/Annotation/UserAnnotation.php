<?php
/**
 * @author Evgeniy Udodov <udodov@tutu.ru>
 *
 * @description Concrete class to process the `@user` annotations. Examples:
 *              `@user anonymous` to stay not logged in
 *              `@user username password`
 *
 */

namespace Core\Annotation;

use Core\Annotation;
use Core\AnnotationsNames;

class UserAnnotation extends Annotation
{
	/**
	 * @param	string           $phpDocs
	 * @param	\ReflectionClass $classReflection
	 * @return	mixed
	 * @throws	\Exception
	 */
	protected function _processDocs($phpDocs, $classReflection)
	{
		$userAnnotation = AnnotationsNames::USER;
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
		\Logger::log("Предыдущий или текущий результат не массив, но оба не null. Возвращаем пустой массив");
		return [];
	}
}
