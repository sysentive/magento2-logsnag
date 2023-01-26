# Magento 2 LogSnag plugin
Magento 2 LogSnag Plugin allows stores owners to send order events to LogSnag (event tracking tool) and receive push notifications when order is placed, shipped, etc.

## Roadmap

> **Warning**
> This is work in progress. We are building this in public.
- [X] Configuration in admin
- [X] Send new order event
- [ ] Add to packagist
- [ ] Send new shipment event
- [ ] Send out of stock event

## 1. How to install Magento 2 LogSnag extension

### Install module via composer (coming soon)

### Install Package from copy-paste package

Download the latest version from this repo and upload files to `app/code/Sysentive/LogSnag` in your Magento folder.

```
php bin/magento module:enable Sysentive_LogSnag
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

## License

Licensed under the [MIT license](https://github.com/sysentive/magento-2-logsnag/blob/main/README.md).