<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description Tests on processing ArrayAnnotation for @domains
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Annotation\ArrayAnnotation;
use src\AnnotationProcessor;
use tests\Helpers\PathHelper;

class DomainsAnnotationTest extends TestCase
{
	private $_testClassWithAnnotations = PathHelper::CLASS_WITH_ANNOTATIONS_PATH;

	/**
	 * @dataProvider getProcessDomainsAnnotationTestData
	 * @param $class
	 * @param $methodName
	 * @param $expectedResult
	 */
	public function testProcessDomainsAnnotation($class, $methodName, $expectedResult)
	{
		$annotationProcessor = new AnnotationProcessor($class, $methodName);
		$result = $annotationProcessor->process(new ArrayAnnotation('@domains'));
		$this->assertEquals($expectedResult, $result, 'Domains annotation is processed unexpectedly.');
	}

	public function getProcessDomainsAnnotationTestData()
	{
		return [
			'testWithDomainsDevelAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsDevelAnnotation',
				['awdawdaw']
			],
			'testWithDomainsRcAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsRcAnnotation',
				['rc']
			],
			'testWithDomainsProductionAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsProductionAnnotation',
				['production']
			],
			'testWithDomainsProductionAndDevelAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsProductionAndDevelAnnotation',
				['production', 'devel']
			],
			'testWithDomainsProductionAndRcAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsProductionAndRcAnnotation',
				['production', 'rc']
			],
			'testWithDomainsRcAndDevelAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsRcAndDevelAnnotation',
				['rc', 'devel']
			],
			'testWithDomainsRcDevelProductionAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithDomainsRcDevelProductionAnnotation',
				['rc', 'devel', 'production']
			],
			'testWithEmptyDomainsAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithEmptyDomainsAnnotation',
				[]
			],
			'testWithoutDomainsAnnotation' => [
				$this->_testClassWithAnnotations,
				'testWithNoAnnotations',
				[]
			],
		];
	}
}