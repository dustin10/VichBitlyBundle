VichBitlyBundle
===============

This bundle allows you to easily interact with the [bit.ly](http://bit.ly) 
REST API in your Symfony2 application.

## Installation

### Get the files

Install the bundle files to the `vendor/bundles/Vich/BitlyBundle` directory.

This can be done in several ways, depending on your preference. The first
method is the standard Symfony method for doing this

**Using the vendors script**

Add the following lines in your `deps` file:

```
[VichBitlyBundle]
    git=git://github.com/dustin10/VichBitlyBundle.git
    target=bundles/Vich/BitlyBundle
```

Now, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```
**Using submodules**
 
If you prefer instead to use git submodules, the run the following:

``` bash
$ git submodule add git://github.com/dustin10/VichBitlyBundle.git vendor/bundles/Vich/BitlyBundle
$ git submodule update --init
```

### Configure the Autoloader

Add the `Vich` namespace to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...

    'Vich' => __DIR__.'/../vendor/bundles',
));
```

### Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new Vich\BitlyBundle\VichBitlyBundle(),
    );
}
```

### Configure the bundle

Now open up your `config.yml` file and add the following to configure the 
bundle.

``` yaml
vich_bitly:
    login_name: my_login_name
    api_key: my_api_key
```

Make sure you replace the `login_name` and `api_key` values with yours.

## Shortening Urls

Now that the bundle is configured it is quite easy to shorten urls on the fly. 
The bit.ly api service name is `vich_bitly.api`. Here is an example of shortening 
a url in a controller.

``` php
class MainController extends Controller
{
    public function shortenAction()
    {
        $url = 'https://github.com/dustin10';
        $shortenedUrl = $this->get('vich_bitly.api')->shorten($url);

        // ..
    }
}
```

At this point the variable `$shortenedUrl` contains the shortened url. Yes, it 
is that simple.

You can inject the `vich_bitly.api` service anywhere you need to shorten urls 
using the bit.ly service.

**Note:** If for any reason the request to the bit.ly api fails then the original 
long url is returned from the `shorten` method.

## Expanding Urls

Expanding shortened urls is also supported. Here is an example of expanding a url 
in a controller.

``` php
class MainController extends Controller
{
    public function expandAction()
    {
        $url = 'http://bit.ly/A3aid';
        $expandedUrl = $this->get('vich_bitly.api')->expand($url);

        // ..
    }
}
```

Now `$expandedUrl` contains the expanded url.

**Note:** If for any reason the request to the bit.ly api fails then the original 
short url is returned from the `expand` method.

## Twig Functions

If you don't want to shorten urls in the controller then you can shorten them 
right in your Twig template using the following function.

``` twig
{{ vich_bitly_shorten(url) }}
```