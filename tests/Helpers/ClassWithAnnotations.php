<?php
/**
 * @author Sakharov Maksim <sakharov@tutu.ru>
 *
 * @description This a dummy class with all annotations for testing purposes
 */

namespace tests\Helpers;

use tests\Helpers\Maintainers;
use tests\Helpers\LabelsExcursions;
use tests\Helpers\Domains;
use PHPUnit\Framework\TestCase;

class ClassWithAnnotations extends TestCase
{
	// Указание метода сетап нужно для симуляции сетапа в тестах, когда у него не указан док
	public function setUp()
	{
		parent::setUp();
	}

	/*
	 * BoolAnnotationsTest
	 */

	/**
	 * @onDemand
	 */
	public function testWithOnDemandAnnotation() { }

	/**
	 * @noscreenshot
	 */
	public function testWithNoScreenshotAnnotation() { }

	/**
	 * @case
	 */
	public function testWithTestCaseAnnotation() { }

	/**
	 * @todocase
	 */
	public function testWithTodoCaseAnnotation() { }

	/**
	 * @manualcase
	 */
	public function testWithManualCaseAnnotation() { }

	/**
	 * @bug
	 */
	public function testWithBugAnnotation() { }

	/*
	 * DomainsAnnotationsTest
	 */

	/**
	 * @domains Domains::DEVEL
	 */
	public function testWithDomainsDevelAnnotation() { }

	/**
	 * @domains Domains::RC
	 */
	public function testWithDomainsRcAnnotation() { }

	/**
	 * @domains Domains::PRODUCTION
	 */
	public function testWithDomainsProductionAnnotation() { }

	/**
	 * @domains Domains::PRODUCTION, Domains::DEVEL
	 */
	public function testWithDomainsProductionAndDevelAnnotation() { }

	/**
	 * @domains Domains::PRODUCTION, Domains::RC
	 */
	public function testWithDomainsProductionAndRcAnnotation() { }

	/**
	 * @domains Domains::RC, Domains::DEVEL
	 */
	public function testWithDomainsRcAndDevelAnnotation() { }

	/**
	 * @domains Domains::RC, Domains::DEVEL, Domains::PRODUCTION
	 */
	public function testWithDomainsRcDevelProductionAnnotation() { }

	/**
	 * @domains
	 */
	public function testWithEmptyDomainsAnnotation() { }

	/*
	 * CaseAnnotationsTest
	 */

	/**
	 * @case Письмо с pkpass
	 *       - Тема письма
	 *       - Обращение
	 *       - Информационный блок
	 *       - Перечень документов
	 */
	public function testWithCaseAnnotation() { }

	/*
	 * LabelsAnnotationsTest
	 */

	/**
	 * @labels LabelsExcursions::TITLE
	 */
	public function testWithLabelsAnnotation() { }

	/**
	 * @labels LabelsExcursions::EXCURSION_PAGE, LabelsExcursions::TITLE
	 */
	public function testWithSeveralLabels() { }

	/*
	 * MaintainerAnnotationsTest
	 */

	/**
	 * @maintainer Maintainers::MAINTAINER_1
	 */
	public function testWithMaintainerAnnotation() { }

	/*
	 * UserAnnotationsTest
	 */

	/**
	 * @user maintainer_2@tutu.ru AllahuAkbar99
	 */
	public function testWithUserWithPassword() { }

	/**
	 * @user maintainer_2@tutu.ru AllahuAkbar99
	 * @domains Domains::RC
	 */
	public function testWithUserWithPasswordAndConstantAfter() { }

	/**
	 * @user anonymous
	 */
	public function testWithUserAnonymous() { }

	/**
	 * @user trespasser
	 * @domains Domains::DEVEL
	 */
	public function testWithUserWithoutPassword() { }

	/**
	 * @user anonymous
	 * @domains Domains::DEVEL
	 */
	public function testWithUserAnonymousAndConstantAfter() { }

	/*
	 * For all of the above
	 */

	public function testWithNoAnnotations() { }
}
