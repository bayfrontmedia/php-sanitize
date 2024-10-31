## PHP sanitize

Simple class used to sanitize, filter and cast data.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0`

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
- `$type = self::CAST_STRING` (string): Any `CAST_*` constant

Valid cast types are available as the following constants:

- `CAST_ARRAY`: array
- `CAST_BOOL`: bool
- `CAST_FLOAT`: float
- `CAST_INT`: int
- `CAST_OBJECT`: object
- `CAST_STRING`: string

**Returns:**

- (mixed)

**Example:**

```
use Bayfront\Sanitize\Sanitize;

$input = '1.42';

echo Sanitize::cast($input, Sanitize::CAST_FLOAT);

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