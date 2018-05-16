<?php
declare(strict_types = 1);
/**
 * @author Maksim Sakharov <sakharov@tutu.ru>
 *
 * @description Process annotation for case and todocase phpDocs
 */

namespace src\Annotation;

use src\Annotation;

class CaseAnnotation extends Annotation
{
	protected $_defaultResult = '';

	/**
	 * @var string
	 */
	private $_tag;

	/**
	 * CaseAnnotation constructor.
	 *
	 * @param string $tag The PhpDoc tag, eg. "@case", "@todocase", "@bug", "@manualcase", etc.
	 */
	public function __construct($tag)
	{
		isset($tag)
			? $this->_tag = $tag
			: new \Exception("Tag is not set" );
	}

	/**
	 * @param	string				$phpDocs
	 * @param	\ReflectionClass	$classReflection
	 *
	 * @return mixed
	 */
	protected function _processDocs(string $phpDocs, \ReflectionClass $classReflection)
	{
		return preg_match_all("/($this->_tag)(.*)((\*\/)|(\*\s*@))/sU", $phpDocs, $matches)
			? $this->_clearComment($matches[2][0])
			: null;
	}

	/**
	 * @param mixed $previousResult
	 * @param mixed $newResult
	 * @return string
	 */
	protected function _mergeResult($previousResult, $newResult)
	{
		return ($previousResult && $newResult)
			? $previousResult . "\n" . $newResult
			: $previousResult . $newResult;
	}

	private function _clearComment($comment)
	{
		$strings = explode("\n", $comment);
		$new_comment = [];
		foreach ($strings as $str)
		{
			//Убираем первую все пробелы в начале строки и, если в начале строки есть *, то * и пробел после нее
			$new_comment[] = preg_replace(['/^\s*(\*\s)?/'], '', $str, 1);
		}
		$result = implode("\n", $new_comment);
		$parsedown = new \Parsedown();
		return $parsedown->text($result);
	}
}
