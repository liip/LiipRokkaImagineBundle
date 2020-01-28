# LiipRokkaImagineBundle

[![Travis Build](https://travis-ci.com/liip/LiipRokkaImagineBundle.svg?branch=master)](https://travis-ci.com/liip/LiipRokkaImagineBundle)

## Overview
When using [Rokka.io](https://rokka.io/) together with Symfony we recommend to use the [Rokka client bundle](https://github.com/rokka-io/rokka-client-bundle), but this bundle serves as a stepping stone and provides you with ability to use [Rokka.io](https://rokka.io/) service as a driver to [LiipImagineBundle](https://github.com/liip/LiipImagineBundle)

It takes your existing imagine configuration and generates Rokka stacks for you with the same name as the imagine filter set. It then uses the stacks from Rokka on the fly, so that you don't have to change anything in your code. It's nearly a drop-in replacement. 

**NOTE: While we do testing for the conversion from LiipImagineBundle configuration to rokka stacks, there might still be visual differences, or bugs in the conversion. Please sanity check the generated stacks before switching a production website.**

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
$ composer require liip/rokka-imagine-bundle
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle:

```php
// config/bundles.php
return [
    ...
    Liip\RokkaImagineBundle\LiipRokkaImagineBundle::class => ['all' => true],
];
```

### Step 3: Configure the Bundle

Add following parameters to your parameters file:

```yaml
liip_rokka_imagine.rokka.organization: 'your_rokka_organization'
liip_rokka_imagine.rokka.api_key: 'your_rokka_api_key'
liip_rokka_imagine.images_dir: '/path/to/the/images/dir/'
```

Execute following command in order to export your defined filter and filter sets from LiipImagineBundle configuration to Rokka.io:

```
$ bin/console liip:rokka-imagine:config:sync
```

To ouptut your images through rokka, adjust the LiipImagineBundle configuration to use `rokka` as cache:

```yaml
# config/packages/imagine.yaml
liip_imagine:
    cache: rokka
```
