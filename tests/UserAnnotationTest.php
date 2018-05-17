<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Tests on processing UserAnnotation
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Annotation\UserAnnotation;
use src\AnnotationProcessor;
use tests\Helpers\PathHelper;

class UserAnnotationTest extends TestCase
{
	private $_testClassWithAnnotations = PathHelper::CLASS_WITH_ANNOTATIONS_PATH;

	/**
	 * @dataProvider getProcessUserAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessUserAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new UserAnnotation());
		$this->assertEquals($expectedResult, $result, 'User annotation is processed unexpectedly.');
	}

	/**
	 * @expectedException \Exception
	 */
	public function testExceptionThrownForUserWithoutPassword()
	{
		$annotationProcessor = new AnnotationProcessor($this->_testClassWithAnnotations, 'testWithUserWithoutPassword');
		$annotationProcessor->process(new UserAnnotation());
	}

	public function getProcessUserAnnotationTestData()
	{
		return [
			'testWithUserWithPassword' => [
				$this->_testClassWithAnnotations,
				'testWithUserWithPassword',
				[
					'username' => 'maintainer_2@tutu.ru',
					'password' => 'AllahuAkbar99'
				]
			],
			'testWithUserWithPasswordAndConstantAfter' => [
				$this->_testClassWithAnnotations,
				'testWithUserWithPasswordAndConstantAfter',
				[
					'username' => 'maintainer_2@tutu.ru',
					'password' => 'AllahuAkbar99'
				]
			],
			'testWithUserAnonymous' => [
				$this->_testClassWithAnnotations,
				'testWithUserAnonymous',
				[
					'username' => 'anonymous',
					'password' => null
				]
			],
			'testWithUserAnonymousAndConstantAfter' => [
				$this->_testClassWithAnnotations,
				'testWithUserAnonymousAndConstantAfter',
				[
					'username' => 'anonymous',
					'password' => null
				]
			],
			'testWithoutUserAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				[]
			],
		];
	}
}
