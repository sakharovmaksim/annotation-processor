<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Tests on processing CaseAnnotation
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Annotation\CaseAnnotation;
use src\AnnotationProcessor;
use tests\Helpers\PathHelper;

class CaseAnnotationTest extends TestCase
{
	private $_testClassWithAnnotations = PathHelper::CLASS_WITH_ANNOTATIONS_PATH;

	/**
	 * @dataProvider getProcessCaseAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessCaseAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new CaseAnnotation('@case'));
		$this->assertEquals($expectedResult, $result, 'Case annotation is processed unexpectedly.');
	}

	public function getProcessCaseAnnotationTestData()
	{
		return [
			'testWithCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithCaseAnnotation',
				"<p>Письмо с pkpass</p>\n<ul>\n<li>Тема письма</li>\n<li>Обращение</li>\n<li>Информационный блок</li>\n"
				. "<li>Перечень документов</li>\n</ul>"
			],
			'testWithoutCaseAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				''
			],
		];
	}
}
