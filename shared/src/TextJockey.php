<?php
/**
 * TJ - text jockey core by ax710 and y-a-v-a.org
 * Extracts a random sentence part from a source text.
 * @package TJ
 * @copyright 2010 y-a-v-a.org, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 */
class TextJockey {

	/**
	 * Extract a random sentence part from $text.
	 *
	 * @param string $text source text to sample from
	 * @param int $sp sentence part: 0 = sentence start, 1 = middle, 2 = sentence end
	 * @return string|false a random match, or false when nothing matched
	 */
	public static function extract($text, $sp) {
		// do some regexp to get the right sentence part
		switch ($sp) {
			case 0:
				preg_match_all("/[A-Z]{1}[a-z]*[ ]{1}([a-z0-9:\-,]*[ ]){4,12}/", $text, $matches);
				break;
			case 1:
				preg_match_all("/[ ]{1}[a-z]{1}([A-Za-z\-,:]*[ ]){6,}/", $text, $matches);
				break;
			case 2:
			default:
				preg_match_all("/([ ]+?[a-z][A-Za-z\-,:]*){6,13}([\.\?!]){1}/", $text, $matches, PREG_PATTERN_ORDER);
				break;
		}

		if (isset($matches[0]) && count($matches[0]) > 0) {
			return $matches[0][rand(0, count($matches[0]) - 1)];
		}
		return false;
	}
}
