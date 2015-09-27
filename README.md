# elgentos Mailcheck
This is the [Mailcheck](https://github.com/mailcheck/mailcheck) extension for Magento. It checks the users input in the email field for common typo mistakes in the domain part.

There are a number of default domains such as gmail.com and hotmail.com. The extension supplements these with the most commonly used domains in your Magento store. The cut off point of the number occurences it needs to add it to the domain list is configurable (defaults to 50).

Configuration can be found under System > Configuration > Customer > Customer Configuration > Mailcheck.

The configuration settings are fetched through an AJAX call on the customer account login page. They are cached in the /var folder in JSON files. These files are (re-)generated upon cache clearing and saving of the customer section of the Magento configuration.

## Screenshot
![screenshot 2015-03-18 16 26 09](https://cloud.githubusercontent.com/assets/431360/6712189/909c1ca4-cd8b-11e4-8eac-9162ce4c3553.png)

## Configurable settings screenshot
![screenshot 2015-03-18 16 27 53](https://cloud.githubusercontent.com/assets/431360/6712231/c39aab98-cd8b-11e4-9dc1-d195fa851917.png)

## Changelog
### v0.2.0 - 27-09-2015
Fixed a few bugs where some vars weren't named correctly.
Added an option to warn a user about using a disposable domain. Uses the disposable domain list from [FGRibreau / mailchecker](https://github.com/FGRibreau/mailchecker).

## Judge report
```
Vendor: Elgentos
Extension: Mailcheck
Version: 0.1.0
Extensions ~/Mailcheck have passed the check CoreHacks
Extensions ~/Mailcheck have passed the check Rewrites
Extensions ~/Mailcheck have passed the check CodeRuin
Extensions ~/Mailcheck have passed the check PhpCompatibility
* php_compatibility: Extension is compatible to PHP from version 5.0.0 up to latest versions
* mage_compatibility: Extension uses 3 classes and 26 methods of Magento core
* mage_compatibility: Checked Magento versions: CE 1.4.1.1, CE 1.4.2.0, CE 1.5.0.1, CE 1.5.1.0, CE 1.6.1.0, CE 1.6.2.0, CE 1.7.0.0, CE 1.7.0.1, CE 1.7.0.2, EE 1.10.0.1, EE 1.10.0.2, EE 1.10.1.1, EE 1.8.0.0, EE 1.9.0.0, EE 1.9.1.1
* Extension seems to support following Magento versions: CE 1.4.1.1, CE 1.4.2.0, CE 1.5.0.1, CE 1.5.1.0, CE 1.6.1.0, CE 1.6.2.0, CE 1.7.0.0, CE 1.7.0.1, CE 1.7.0.2, EE 1.10.0.1, EE 1.10.0.2, EE 1.10.1.1, EE 1.8.0.0, EE 1.9.0.0, EE 1.9.1.1
* mage_compatibility: Extension supports Magento at least from CE version 1.5.0.0 and EE version 1.10.0.0
Extensions ~/Mailcheck have passed the check CheckStyle
Extensions ~/Mailcheck have passed the check CheckComments
* cloc_to_ncloc: 0.01
Extensions ~/Mailcheck have passed the check CodeCoverage
Extensions ~/Mailcheck have passed the check SecurityCheck
Extensions ~/Mailcheck have passed the check PerformanceCheck
```
This is a small report by [Judge](http://judge.nr-apps.com/) - a tool to examine Magento extensions regarding their quality and compatibility.
