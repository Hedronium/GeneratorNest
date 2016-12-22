<?php
namespace Hedronium\GeneratorNest;

use Iterator;
use Generator;

class GeneratorNest
{
	public static function nested(Iterator $ranger)
	{
		$cur = 0;
		$gens = [$ranger];

		while ($cur > -1) {
			if ($gens[$cur]->valid()) {
				$key = $gens[$cur]->key();
				$val = $gens[$cur]->current();

				$gens[$cur]->next();

				if ($val instanceof Generator) {
					$gens[] = $val;
					$cur++;

				} else {
					yield $key => $val;

				}

			} else {
				array_pop($gens);
				$cur--;

			}
		}
	}
}
