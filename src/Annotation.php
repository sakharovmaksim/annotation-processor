<?php
declare(strict_types = 1);
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Abstract strategy of annotation processing.
 */

namespace src;

abstract class Annotation
{
	// Different annotations can have different default result (for cases when neither class nor methods have PHPDocs)
	protected $_defaultResult = [];
	protected $_defaultArrayResult = ['class' => '', 'setup' => '', 'doc_comment' => ''];

	/**
	 * @param	string				$phpDocs
	 * @param	\ReflectionClass	$classReflection
	 * @return	mixed
	 */
	abstract protected function _processDocs(string $phpDocs, \ReflectionClass $classReflection);

	/**
	 * @param mixed $previousResult
	 * @param mixed $newResult
	 * @return mixed
	 */
	abstract protected function _mergeResult($previousResult, $newResult);

	/**
	 * @param \ReflectionClass  $reflectionClass
	 * @param \ReflectionMethod $reflectionSetUpMethod
	 * @param \ReflectionMethod $reflectionMethod
	 *
	 * @return mixed
	 */
	public function process(
		\ReflectionClass $reflectionClass,
		\ReflectionMethod $reflectionSetUpMethod,
		\ReflectionMethod $reflectionMethod
	)
	{
		$result = $this->_defaultResult;

		if ($classPhpDocs = $reflectionClass->getDocComment())
		{
			$classResults = $this->_processDocs($classPhpDocs, $reflectionClass);
			$result = $this->_mergeResult($result, $classResults);
		}

		if ($setupMethodPhpDocs = $reflectionSetUpMethod->getDocComment())
		{
			$setupMethodResults = $this->_processDocs($setupMethodPhpDocs, new \ReflectionClass($reflectionSetUpMethod->class));
			$result = $this->_mergeResult($result, $setupMethodResults);
		}

		if ($methodPhpDocs = $reflectionMethod->getDocComment())
		{
			$methodResults = $this->_processDocs($methodPhpDocs, new \ReflectionClass($reflectionMethod->class));
			$result = $this->_mergeResult($result, $methodResults);
		}

		return $result;
	}

	/**
	 * @param \ReflectionClass  $reflectionClass
	 * @param \ReflectionMethod $reflectionSetUpMethod
	 * @param \ReflectionMethod $reflectionMethod
	 *
	 * @return mixed
	 */
	public function processAsArray(
		\ReflectionClass $reflectionClass,
		\ReflectionMethod $reflectionSetUpMethod,
		\ReflectionMethod $reflectionMethod
	)
	{
		$result = $this->_defaultArrayResult;

		if ($classPhpDocs = $reflectionClass->getDocComment())
		{
			$classResults = $this->_processDocs($classPhpDocs, $reflectionClass);
			$result['class'] = $this->_mergeResult($result['class'], $classResults);
		}

		if ($setupMethodPhpDocs = $reflectionSetUpMethod->getDocComment())
		{
			$setupMethodResults = $this->_processDocs($setupMethodPhpDocs, new \ReflectionClass($reflectionSetUpMethod->class));
			$result['setup'] = $this->_mergeResult($result['setup'], $setupMethodResults);
		}

		if ($methodPhpDocs = $reflectionMethod->getDocComment())
		{
			$methodResults = $this->_processDocs($methodPhpDocs, new \ReflectionClass($reflectionMethod->class));
			$result['doc_comment'] = $this->_mergeResult($result['doc_comment'], $methodResults);
		}

		return $result;
	}

	protected function _evaluateConstant(string $annotationValue, \ReflectionClass $reflectionClass) : string
	{
		if (strpos($annotationValue, '::') !== false)
		{
			$constantName = ReflectionHelper::getFullConstantName($reflectionClass, $annotationValue);
			$constant = @constant($constantName);
			if (is_null($constant))
			{
				throw new \Exception(
					"Не удалось получить значение константы {$constantName} в классе {$reflectionClass->name}"
					. "\nКласс с константой точно в нём заюзан?"
				);
			}
			return $constant;
		}
		return $annotationValue;
	}
}
