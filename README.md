# Drupal Commerce - Terms and Conditions Checkout Pane

## What does this module do?
This simple module adds "Terms and conditions" checkout pane for your Drupal Commerce website allowing users to "agree" to those terms before placing an order.

## Requirements
- Drupal Commerce
- Drupal 8 / 9 (not tested in 9 but it should work)

## Installation
To install this module you will want to put the source in the [appropriate directory](https://www.drupal.org/docs/8/extending-drupal-8/installing-modules#mod_location).
After you have placed the module there, simply enable it as you would any other module.

## Configuring
Navigate to your checkout order flow (most likely /admin/commerce/config/checkout-flows/manage/default) and place newly created checkout pane wherever you want. Configure the link as well under the cogwheel.
Depending on language of your website you might want to translate the text next to a checkbox on checkout pane, this could be easily done by navigating to User Interface Translation (typically /admin/config/regional/translate) and searching with query "I agree with" which should yield the correct result. 
