<?php
/**
 * God is a TJ by ax710 and y-a-v-a.org
 * @package God is a TJ
 * @copyright 2010 y-a-v-a.org, ax710
 * @license creative commons - http://creativecommons.org/licenses/by/3.0/nl/
 * @version 0.5 jul 2026
 */
$site = array(
	'title' => 'God is a TJ',
	'title_class' => 'color2',
	'keywords' => 'TJ, text jockey, god, ax710, y-a-v-a',
	'description' => 'God is a TJ',
	'ie_compat' => false,
	'endpoint' => 'getline.php',
	'delayed_next' => true,
	'creators' => array(
		array('name' => 'ax710', 'url' => 'https://www.ax710.org/', 'class' => 'color1'),
		array('name' => 'y-a-v-a', 'url' => 'https://www.y-a-v-a.org/', 'class' => 'color3'),
	),
	'jsonld' => <<<'JSONLD'
	{
		"@context": "https://schema.org",
		"@type": "VisualArtwork",
		"name": "God is a TJ",
		"creator": [
			{
				"@type": "Person",
				"name": "ax710",
				"url": "https://www.ax710.org/"
			},
			{
				"@type": "Person",
				"name": "y-a-v-a",
				"url": "https://www.y-a-v-a.org/"
			}
		],
		"dateCreated": "2010",
		"genre": "Internet Art",
		"artform": "Digital Art",
		"artMedium": "Web Browser",
		"about": "Scripture read back as an endless, colour-cycling live text mix",
		"description": "A text jockey that endlessly samples the King James Bible line by line, mixing scripture into a never-ending stream of coloured text",
		"keywords": [
			"internet art",
			"digital art",
			"web art",
			"generative art",
			"text jockey",
			"bible"
		],
		"url": "http://www.god-is-a-tj.com/",
		"isAccessibleForFree": true,
		"license": "https://creativecommons.org/licenses/by/3.0/nl/",
		"inLanguage": "en",
		"audience": {
			"@type": "Audience",
			"audienceType": "Digital Art Enthusiasts"
		},
		"isBasedOn": {
			"@type": "Book",
			"name": "The King James Bible",
			"url": "https://www.gutenberg.org/ebooks/10"
		}
	}
JSONLD,
);

require __DIR__ . '/../../../shared/template.php';
