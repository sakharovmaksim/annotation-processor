<?php
declare(strict_types = 1);
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Concrete class to process annotations that have no value and can be either present or not.
 */

namespace src\Annotation;

use src\Annotation;

class BoolAnnotation extends Annotation
{
	protected $_defaultResult = false;

	/**
	 * @var string
	 */
	private $_tag;

	/**
	 * BoolAnnotation constructor.
	 *
	 * @param string $tag The PhpDoc tag, eg. "@noscreenshot" or "@onDemand".
	 */
	public function __construct($tag)
	{
		$this->_tag = $tag;
	}

	/**
	 * @param	string				$phpDocs
	 * @param	\ReflectionClass	$classReflection
	 *
	 * @return mixed
	 */
	protected function _processDocs(string $phpDocs, \ReflectionClass $classReflection)
	{
		return strpos($phpDocs, $this->_tag) !== false;
	}

	/**
	 * @param mixed $previousResult
	 * @param mixed $newResult
	 * @return bool
	 */
	protected function _mergeResult($previousResult, $newResult)
	{
		return $previousResult || $newResult;
	}
}
