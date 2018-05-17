<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Tests on processing ArrayAnnotation for @maintainer
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Annotation\ArrayAnnotation;
use src\AnnotationProcessor;
use tests\Helpers\PathHelper;

class MaintainerAnnotationTest extends TestCase
{
	private $_testClassWithAnnotations = PathHelper::CLASS_WITH_ANNOTATIONS_PATH;

	/**
	 * @dataProvider getProcessMaintainerAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessMaintainerAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new ArrayAnnotation('@maintainer'));
		$this->assertEquals($expectedResult, $result, 'Maintainer annotation is processed unexpectedly.');
	}

	public function getProcessMaintainerAnnotationTestData()
	{
		return [
			'testWithMaintainerAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithMaintainerAnnotation',
				['maintainer_1@tutu.ru']
			],
			'testWithoutMaintainerAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				[]
			],
		];
	}
}
