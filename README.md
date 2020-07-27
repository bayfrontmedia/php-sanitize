## PHP sanitize

Simple class used to sanitize, filter and cast data.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](https://github.com/bayfrontmedia/php-array-helpers/blob/master/LICENSE).

## Author

John Robinson, [Bayfront Media](https://www.bayfrontmedia.com)

## Requirements

* PHP > 7.1.0

## Installation

```
composer require bayfrontmedia/php-sanitize
```

## Usage

- [cast](#cast)
- [email](#email)
- [url](#url)
- [path](#path)
- [escape](#escape)

<hr />

### cast

**Description:**

Ensures a given variable will be returned as a specific type. Defaults to "string".

**Parameters:**

- `$var` (mixed)
- `$type = 'string'` (string)

Valid `$type` values are:

- `int`
- `float`
- `bool`
- `object`
- `array`
- `string`

**Returns:**

- (mixed)

**Example:**

```
use Bayfront\Sanitize\Sanitize;

$input = '1.42';

echo Sanitize::cast($input, 'float');

```

<hr />

### email

**Description:**

Filters string for valid email characters.

**Parameters:**

- `$email` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\Sanitize\Sanitize;

echo Sanitize::email('email@example.com');
```

<hr />

### url

**Description:**

Filters string for valid URL characters.

**Parameters:**

- `$url` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\Sanitize\Sanitize;

echo Sanitize::url('https://www.example.com);
```

<hr />

### path

**Description:**

Filters string for valid path syntax, with optional trailing slash.

This method removes any whitespace, spaces, and leading slashes. It will also convert reverse and multiple slashes to one single forward slash.

**Parameters:**

- `$path` (string)
- `$trailing = true` (bool): Require trailing slash

**Returns:**

- (string)

**Example:**

```
use Bayfront\Sanitize\Sanitize;

$path = '/some/ bad//path';

echo Sanitize::path($path);

```

<hr />

### escape

**Description:**

Escape strings and arrays. Other data types return their original value.

**NOTE:** Use caution when escaping entire arrays, as strings should typically only be escaped when outputting to HTML.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$value` (mixed)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (mixed)

**Example:**

```
use Bayfront\Sanitize\Sanitize;

$html = '<a href="#">Hyperlink</a>';

echo Sanitize::escape($html);

```