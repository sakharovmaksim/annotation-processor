<?php
declare(strict_types = 1);
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description The client that processes annotations with accepted strategy (Annotation subclasses)
 */

namespace src;

class AnnotationProcessor
{
	/**
	 * @var \ReflectionClass
	 */
	private $_reflectionClass;

	/**
	 * @var \ReflectionMethod
	 */
	private $_reflectionMethod;

	/**
	 * @var \ReflectionMethod
	 */
	private $_reflectionSetUpMethod;

	/**
	 * AnnotationProcessor constructor.
	 *
	 * @param string $class The class full (with a namespace) name.
	 * @param string $method The method name.
	 */
	public function __construct(string $class, string $method)
	{
		$this->_reflectionClass = new \ReflectionClass($class);
		$this->_reflectionSetUpMethod = new \ReflectionMethod($class, 'setUp');
		$this->_reflectionMethod = new \ReflectionMethod($class, $method);
	}

	/**
	 * @param \Core\Annotation $annotation The strategy of annotation processing.
	 *
	 * @return mixed
	 */
	public function process(Annotation $annotation)
	{
		return $annotation->process(
			$this->_reflectionClass,
			$this->_reflectionSetUpMethod,
			$this->_reflectionMethod
		);
	}

	/**
	 * @param \Core\Annotation $annotation The strategy of annotation processing.
	 *
	 * @return mixed
	 */
	public function processAsArray(Annotation $annotation)
	{
		return $annotation->processAsArray(
			$this->_reflectionClass,
			$this->_reflectionSetUpMethod,
			$this->_reflectionMethod
		);
	}
}