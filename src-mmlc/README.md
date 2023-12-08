# Translator

## Example

```php
use Grandeljay\Translator\Translations;

$translations = new Translations(__FILE__);
$translations->add('TITLE', 'grandeljay - Translator');
$translations->add('TEXT_TITLE', 'Translator');

/**
 * These are optional and will be handled by the library automatically!
 */
$translations->add('STATUS_TITLE', 'Status');
$translations->add('STATUS_DESC', 'Select Yes to activate the module and No to deactivate it.');
/** */

$translations->define();
```
