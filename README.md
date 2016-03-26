# ReCaptcha 1.0.0

Simple PHP Library, designed for verifications of Google reCaptcha. 

### Why ? 

Simple answer for this question is "I really don't know" :)  but seriously, it is very simple project ideal for learning several PHP-Development tools, and if this library could be usefull for someone else that's great.

### How to install

[[This section will be updated after publishing package on packagist]]

### How to use package

After installing / downloading package you can use it in very simple way. First of all if you are not using Composer autoloader (or any PSR-4 compatible loader) You should be sure that You include all necessery files, after that it's very simple.

Before you start integrate reCaptcha on your site visit [reCaptcha Page](https://www.google.com/recaptcha/intro/index.html) and generate pair of keys, You can do this by clicking get reCaptch button.

Next add to your html file in \<head> section:

```html
<script src='https://www.google.com/recaptcha/api.js'></script>
```

after that insert this code in place where you want to display your captcha widget (it must be inside \<form>\</form> tags)

```html
<div class="g-recaptcha" data-sitekey="place_your_public_key_here"></div>
```
Now when you refresh page you should see reCaptcha widget, if it's working You can go now to PHP part

Whole code is really simple:

```php
<?php

use \DevStrefa\ReCaptcha\ReCaptcha;
use \DevStrefa\ReCaptcha\Senders\FgcSender;

$reCaptcha = new ReCaptcha('secret_key_here', new FgcSender());
$reCaptcha->setResponse($_POST['g-recaptcha-response']);
$response=$reCaptcha->verify();

if ($response->isSuccess())
{
	echo 'OK';
}
else
{ 
	echo 'Error';
}   
```

That's it! For more informations about library please check included example, and read genereated [documentation](http://devstrefa.github.io/reCaptchaDoc/).


## ToDo

 * More Senders (Curl etc.)

## Changelog

You can see Changelog for this project [here](https://github.com/DevStrefa/ReCaptcha/blob/master/CHANGELOG.md)

### License

Whole code in this repository is Under [MIT license](https://github.com/DevStrefa/ReCaptcha/blob/master/LICENSE)