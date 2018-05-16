<?php
/**
 * @author Maksim Sakharov <sakharov@tutu.ru>
 *
 * @description All available custom annotations names
 */

namespace Core;

class AnnotationsNames
{
	// Настройки окружения
	// Установка пользователя, из под кого будет запущен тест
	const USER = '@user';

	// Настройки среды запуска
	// Тест запустится только при наличии параметра --on-demand
	const ON_DEMAND = '@onDemand';
	// Тест запустится только на доменах из списка (RC, Production, Devel)
	const DOMAINS = '@domains';

	// Если указать лейбл при запуске, то запустятся только те тесты, у которых есть аннотация c этим лейблом
	// Важно: лейбл можно ставить на любые тесты, которые хочется объединить логически
	const LABELS = '@labels';
	// На указанную почту отправится письмо в случае упавшего теста, на каждый ретрай письмо не отправляется, только на последний
	const MAINTAINER = '@maintainer';
	// Не нужно делать скриншот
	const NO_SCREENSHOT = '@noscreenshot';

	// Настройки тестов и тест-кейсов
	// Описание к актуальному тесту
	const TESTCASE = '@case';
	// Тест еще не написан, нужно его написать
	const TODOCASE = '@todocase';
	// Тест заблокирован из-за бага в Приложении
	const BUG = '@bug';
	// Тест автоматизировать нельзя, он должен выполняться руками
	const MANUALCASE = '@manualcase';
}
