silverstripe-changeablelasteditedvalue
======================================

By default SilverStripe 3.1 overwrites the LastEdited field every time you write DataObjects to the database. This module allows you to keep your changes in the LastEdited field on any DataObject. It does not prevent the LastEdited field from getting updated when no manual edits has been done to it, so the module should not interfere with normal writing, only when you have explicitly set your own value to the LastEdited field.

## Installation and configuration

Just the regular installation process: put the folder "changeablelasteditedvalue" to your project's root folder and goto the url /dev/build?flush=all in your browser.

There is nothing to configure. The module works automatically for all objects inherited from DataObject. So just put the module in place and your modifications to the LastEdited field will start to work like magic!

You can also install this via composer:

```
composer require "taitava/siverstripe-changeablelasteditedvalue:*"
```

## Maintainer Contact

 Jarkko Linnanvirta
 posti (at) taitavasti (dot) fi (in English or in Finnish)
 www.taitavasti.fi (only in Finnish)

## Requirements

SilverStripe 3.1.0 or greater. I have tested this only with 3.1.16.