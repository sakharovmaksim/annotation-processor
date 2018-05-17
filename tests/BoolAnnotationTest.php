<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Tests on processing BoolAnnotation
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Annotation\BoolAnnotation;
use src\AnnotationProcessor;
use tests\Helpers\PathHelper;

class BoolAnnotationTest extends TestCase
{
	private $_testClassWithAnnotations = PathHelper::CLASS_WITH_ANNOTATIONS_PATH;

	/**
	 * @dataProvider getProcessOnDemandAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessOnDemandAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new BoolAnnotation('@onDemand'));
		$this->assertTrue(
			$expectedResult === $result,
			'OnDemand annotation is processed unexpectedly.'
		);
	}

	public function getProcessOnDemandAnnotationTestData()
	{
		return [
			'testWithOnDemandAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithOnDemandAnnotation',
				true
			],
			'testWithoutOnDemandAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				false
			],
		];
	}

	/**
	 * @dataProvider getProcessNoScreenshotAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessNoScreenshotAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new BoolAnnotation('@noscreenshot'));
		$this->assertTrue(
			$expectedResult === $result,
			'NoScreenshot annotation is processed unexpectedly.'
		);
	}

	public function getProcessNoScreenshotAnnotationTestData()
	{
		return [
			'testWithNoScreenshotAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoScreenshotAnnotation',
				true
			],
			'testWithoutNoScreenshotAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				false
			],
		];
	}

	/**
	 * @dataProvider getProcessTestCaseAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessTestCaseAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new BoolAnnotation('@case'));
		$this->assertTrue(
			$expectedResult === $result,
			'TestCase annotation is processed unexpectedly.'
		);
	}

	public function getProcessTestCaseAnnotationTestData()
	{
		return [
			'testWithTestCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithTestCaseAnnotation',
				true
			],
			'testWithoutTestCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				false
			],
		];
	}

	/**
	 * @dataProvider getProcessTodoCaseAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessTodoCaseAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new BoolAnnotation('@todocase'));
		$this->assertTrue(
			$expectedResult === $result,
			'TodoCase annotation is processed unexpectedly.'
		);
	}

	public function getProcessTodoCaseAnnotationTestData()
	{
		return [
			'testWithTodoCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithTodoCaseAnnotation',
				true
			],
			'testWithoutTodoCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				false
			],
		];
	}

	/**
	 * @dataProvider getProcessManualCaseAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessManualCaseAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new BoolAnnotation('@manualcase'));
		$this->assertTrue(
			$expectedResult === $result,
			'ManualCase annotation is processed unexpectedly.'
		);
	}

	public function getProcessManualCaseAnnotationTestData()
	{
		return [
			'testWithManualCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithManualCaseAnnotation',
				true
			],
			'testWithoutManualCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				false
			],
		];
	}

	/**
	 * @dataProvider getProcessBugAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessBugAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new BoolAnnotation('@bug'));
		$this->assertTrue(
			$expectedResult === $result,
			'Bug annotation is processed unexpectedly.'
		);
	}

	public function getProcessBugAnnotationTestData()
	{
		return [
			'testWithBugAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithBugAnnotation',
				true
			],
			'testWithoutBugAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				false
			],
		];
	}
}
