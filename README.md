# SYMFONY SHOPWARE CONNECTION API BUNDLE


Vendor library for connection with Api Shopware 5.x platform.


## Requirements
- Shopware 5.x or higher
- PHP 7.1.3 or higher

## Installation

Download the plugin from the release page and enable it in shopware.

## Usage

Update your `services.yaml` in your /config directory and fill in your own values

```
parameters:
    lma_dev.shopware_api.user: {user}
    lma_dev.shopware_api.api_key: {api_key}
    lma_dev.shopware_api.shop_url: https://example.dev/api
services:
    # default configuration for services in *this* file
    LmaDev\ShopwareApi\ConnectionApi:
            bind:
                string $baseUri: '%lma_dev.shopware_api.shop_uri%'
                string $user: '%lma_dev.shopware_api.user%'
                string $apiKey: '%lma_dev.shopware_api.api_key%'
```
## How to use
You can bet from your store's APi by calling the following methods:

<ul>
    <li>get</li>
    <li>post</li>
    <li>put</li>
    <li>delete</li>
</ul>


## Contributing

Feel free to fork and send pull requests!


## Licence

This project uses the MIT License.