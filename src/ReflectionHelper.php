<?php
declare(strict_types = 1);
/**
 * @author Nina Belan <nbelan@tutu.ru>
 *
 * @description Helper for working with reflection classes
 */

namespace Core;

class ReflectionHelper
{
	public static function getDeclaredNameSpaces(\ReflectionClass $class) : array
	{
		$result = [];
		$fileName = $class->getFileName();
		$fileContent = file_get_contents($fileName);

		if (!preg_match_all("#\n(?:use|namespace)\s+([a-zA-Z0-9\\\_]+)\s*;#", $fileContent, $matches))
			return $result;

		foreach ($matches[1] as $nameSpace)
			$result[] = $nameSpace;

		return $result;
	}

	public static function getFullClassNameFromNamespaces(array $declaredNamespaces, string $classString) : string
	{
		foreach ($declaredNamespaces as $declaredNamespace)
		{
			$declarationParts = explode("\\", $declaredNamespace);
			$importedNameSpace = end($declarationParts);
			$classStringFromUseSection = $declaredNamespace . str_replace($importedNameSpace, '', $classString);

			if (class_exists($classStringFromUseSection))
				return $classStringFromUseSection;

			$classNameFromNamespace = $declaredNamespace . "\\" . $classString;
			if (class_exists($classNameFromNamespace))
				return $classNameFromNamespace;
		}
		return $classString;
	}

	public static function getFullClassName(\ReflectionClass $class, string $classString) : string
	{
		if (strpos($classString, "\\") === 0)
			return $classString;

		return self::getFullClassNameFromNamespaces(self::getDeclaredNameSpaces($class), $classString);
	}

	public static function getFullConstantName(\ReflectionClass $class, string $constantString) : string
	{
		$classAndConstantArray = explode('::', $constantString);

		if (count($classAndConstantArray) < 2)
			throw new \Exception('Provided constant name is not valid: ' . var_export($constantString, true));

		$fullClassName = self::getFullClassName($class, $classAndConstantArray[0]);
		return $fullClassName . '::' . $classAndConstantArray[1];
	}
}