![LightCache](./docs/header.png)

# LightCache

A Fast, Easy and FileSystem based Cache for PHP.
## About Author
[Nabeel Ali](https://iconiccodes.com)

Website: [https://iconiccodes.com](https://iconiccodes.com)

Email: [mail2nabeelali@gmail.com](mailto:mail2nabeelali@gmail.com)

## Features

    * Fast
    * Easy
    * Lightweight
    * Supports Expiration


## Installtion
```
composer require nabeelalihashmi/LightCache
```

## Basic Usage
```
$cache = new IconicCodes\LightCache\FilesCache;
$cache->cachedir = __DIR__ . "/cache";

$cache->get('key', function () {
    return ["value", time() + 10]; // cache for 10 seconds
});

$cache->delete('key');

```

## Methods

* `get`
* `getValue`
* `has`
* `delete`
* `set`

### get($key, $callback)
Returns the value of the key. If the key is not found, the callback will be called and the value will be cached. If the key is found, the callback will not be called. The callback shall return an array with the value and the expiration time.

```
$cache-get('key', function() {
    return ["value", time() + 10]; // cache for 10 seconds
});
```

This is probably most used function.

### getValue($key)
Return value if key exists or cache is not exired. If key does not exist, returns false. If cache is expired, returns false.

### has($key)
Returns true if key exists. Doesn't check cache expiration.

### delete($key)
Deletes key from cache. This is probably the second most used function.

## set($key, $value, $expiration)
Sets the value of the key. The expiration time is optional. If not set, the value will be cached for ever.

-------------------------

## License

LightCache is released under permissive licese with following conditions:

* It cannot be used to create adult apps.
* It cannot be used to gambling apps.
* It cannot be used to create apps having hate speech.

### MIT License

Copyright 2022 Nabeel Ali | IconicCodes.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

