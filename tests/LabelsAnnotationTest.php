<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Tests on processing ArrayAnnotation for @labels
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Annotation\ArrayAnnotation;
use src\AnnotationProcessor;
use tests\Helpers\PathHelper;

class LabelsAnnotationTest extends TestCase
{
	private $_testClassWithAnnotations = PathHelper::CLASS_WITH_ANNOTATIONS_PATH;

	/**
	 * @dataProvider getProcessLabelsAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessLabelsAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new ArrayAnnotation('@labels'));
		$this->assertEquals($expectedResult, $result, 'Labels annotation is processed unexpectedly.');
	}

	public function getProcessLabelsAnnotationTestData()
	{
		return [
			'testWithLabelsAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithLabelsAnnotation',
				['title']
			],
			'testWithSeveralLabels' => [
				$this->_testClassWithAnnotations,
				'testWithSeveralLabels',
				['excursion_page', 'title']
			],
			'testWithoutLabelsAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				[]
			],
		];
	}
}
