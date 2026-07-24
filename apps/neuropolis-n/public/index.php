<?php
/**
 * Neuropolis N by ax710 and vincentbruijn
 * @package Neuropolis N
 * @copyright 2010 vincent bruijn, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.3 jul 2026
 */
$site = array(
	'title' => 'Neuropolis N',
	'title_class' => 'color2',
	'ie_compat' => true,
	'endpoint' => 'getline.php',
	'delayed_next' => false, // getline.php sleeps 2s itself
	'creators' => array(
		array('name' => 'ax710', 'url' => 'https://www.ax710.org/', 'class' => 'color1'),
		array('name' => 'alweervincent', 'url' => 'https://www.alweervincent.nl/', 'class' => 'color3'),
	),
	'jsonld' => <<<'JSONLD'
	{
		"@context": "https://schema.org",
		"@type": "VisualArtwork",
		"name": "Neuropolis N",
		"creator": [
			{
				"@type": "Person",
				"name": "ax710",
				"url": "https://www.ax710.org/"
			},
			{
				"@type": "Person",
				"name": "alweervincent",
				"url": "https://www.alweervincent.nl/"
			}
		],
		"dateCreated": "2010",
		"genre": "Internet Art",
		"artform": "Digital Art",
		"artMedium": "Web Browser",
		"about": "Found text recombined into an endless live mix",
		"description": "A text jockey that endlessly samples a collection of collected texts, mixing them line by line into a never-ending stream of coloured text",
		"keywords": [
			"internet art",
			"digital art",
			"web art",
			"generative art",
			"text jockey",
			"found text"
		],
		"url": "https://www.neuropolisn.com/",
		"isAccessibleForFree": true,
		"license": "https://creativecommons.org/licenses/by/3.0/nl/",
		"inLanguage": "en",
		"audience": {
			"@type": "Audience",
			"audienceType": "Digital Art Enthusiasts"
		}
	}
JSONLD,
);

require __DIR__ . '/../../../shared/template.php';
