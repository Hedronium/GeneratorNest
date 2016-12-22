# GeneratorNest

![Generator delegation Meme](http://i.imgur.com/OHXMO7U.jpg)

PHP7 has native support for Generator Delegation (`yield from another_generator()`) but many projects still are written in PHP5 or need to support PHP5 for compatability reasons.

This little package has a generator that allows for generator delegation in PHP5.

## Installation
```bash
composer require hedronium/generator-nest
```

## Usage

Consider that we have this generator.
```PHP
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
```

If you try to iterate over a call to this generator like:

```PHP
foreach (combinations() as $combination) {
	// your code
}
```

you'll recieve 3 strings and few generator objects as they are. This starts to be a problem because now in order to use this generator your calling code must be recursive which almsot defeats the whole purpose of using generators in the first place.

Enter Generator nest.

```PHP
use Hedronium\GeneratorNest\GeneratorNest;

foreach (GeneratorNest::nested(combinations()) as $combination) {
	echo $combination, ' ';
}
```

now the output will simply be

```
a aa aaa aab aac ab aba abb abc ac aca acb acc b ba baa bab bac bb bba bbb bbc bc bca bcb bcc c ca caa cab cac cb cba cbb cbc cc cca ccb ccc
```

TADDA!

## LICENSE
MIT.
