# LiipRokkaImagineBundle

![Travis](https://travis-ci.org/liip/LiipRokkaImagineBundle.svg?branch=master)

## Overview

This bundle provides you with ability to use [Rokka.io](https://rokka.io/) service as a driver to LiipImagineBundle

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
$ composer require liip/rokka-imagine-bundle
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding the following line in the app/AppKernel.php file of your project:

```
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new \Liip\RokkaImagineBundle\LiipRokkaImagineBundle(),
        );

        // ...
    }

    // ...
}
```

### Step 3: Configure the Bundle

Add following parameters to your parameters file:

```
liip_rokka_imagine.rokka.organization: 'your_rokka_organization'
liip_rokka_imagine.rokka.api_key: 'your_rokka_api_key'
liip_rokka_imagine.images_dir: '/path/to/the/images/dir/'
```

Execute following command in order to export your defined filter and filter sets from LiipImagine configuration to Rokka service:

```
$ bin/console liip:rokka-imagine:config:sync
```

Configuration of LiipImagineBundle should be adjusted as well:

```
# config/packages/imagine.yaml
liip_imagine:
    driver: rokka
    cache: rokka
```
