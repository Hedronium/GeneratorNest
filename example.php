<?php
require 'vendor/autoload.php';
use Hedronium\GeneratorNest\GeneratorNest;

function combinations($letters = [])
{
	$chars = ['a', 'b', 'c'];

	foreach ($chars as $char) {
		$merged = array_merge($letters, [$char]);

		yield implode('', $merged);

		if (count($letters) < 2) {
			yield combinations($merged);
		}
	}
}

foreach (GeneratorNest::nested(combinations()) as $combination) {
	echo $combination, ' ';
}
