<?php
/**
 * @author Merkusheva Ludmila <merkusheva@tutu.ru>
 *
 * @description The array annotation
 */

namespace Core\Annotation;

use Core\Annotation;
use Core\Utils\Strings;

class ArrayAnnotation extends Annotation
{
	/**
	 * @var string
	 */
	protected $_tag;

	/**
	 * KvpAnnotation constructor.
	 *
	 * @param string $tag The PhpDoc tag, eg. "@labels", "@maintainer".
	 */
	public function __construct($tag)
	{
		$this->_tag = $tag;
	}

	/**
	 * @param	string 			$phpDocs
	 * @param	\ReflectionClass $classReflection
	 *
	 * @return array|string[] Examples: []|['Labels::SEARCH_FORM', 'Labels::AUTOINPUT']
	 */
	protected function _processDocs($phpDocs, $classReflection)
	{
		$result = [];
		if (preg_match_all("/{$this->_tag}\\s+(.*)\n/", $phpDocs, $matches))
		{
			foreach ($matches[1] as $labelsString)
			{
				$labels = [];
				$labelsStrings = explode(',', Strings::stripAllWhiteSpaces($labelsString));
				foreach ($labelsStrings as $label)
				{
					$labels[] = $this->_evaluateConstant($label, $classReflection);
				}
				$result = array_merge($result, $labels);
			}
		}
		return $result;
	}

	/**
	 * @param mixed $previousResult
	 * @param mixed $newResult
	 * @return array
	 */
	protected function _mergeResult($previousResult, $newResult)
	{
		if (is_array($previousResult) && is_array($newResult))
		{
			return array_merge($previousResult, $newResult);
		}
		if (is_array($previousResult))
		{
			return $previousResult;
		}
		if (is_array($newResult))
		{
			return $newResult;
		}
		return [];
	}
}