# Magento 2 LogSnag plugin
Magento 2 LogSnag Plugin allows stores owners to send order events to LogSnag (event tracking tool) and receive push notifications when order is placed, shipped, etc.

[![Latest Stable Version](https://poser.pugx.org/sysentive/magento2-logsnag/v/stable)](https://packagist.org/packages/sysentive/magento2-logsnag)
[![Total Downloads](https://poser.pugx.org/sysentive/magento2-logsnag/downloads)](https://packagist.org/packages/sysentive/magento2-logsnag)

## Roadmap

> **Warning**
> This is work in progress. We are building this in public.
- [X] Configuration in admin
- [X] Send new order event
- [X] Add to packagist
- [X] Allow toggle parser text/markdown
- [ ] Add "Test event" button in config
- [ ] Add logs to debug/monitor
- [ ] Send new shipment event
- [ ] Send out of stock event
- [ ] Push stats to LogSnag Insights

## 1. How to install Magento 2 LogSnag extension

### Install module via composer (recommend)

We recommend you to install Sysentive_LogSnag module via composer. It is easy to install, update and maintain.

Run the following command in Magento 2 root folder.

#### 1.1 Install

```
composer require sysentive/magento2-logsnag
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

#### 1.2 Upgrade

```
composer update sysentive/magento2-logsnag
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

Run compile if your are in Production mode:

```
php bin/magento setup:di:compile
```

### Install Package from copy-paste package

Download the latest version from this repo and upload files to `app/code/Sysentive/LogSnag` in your Magento folder.

```
php bin/magento module:enable Sysentive_LogSnag
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

## Use Cases
- Send a push notification to your phone when an order is placed on Magento 2
- Get a notification when an order is placed on Magento 2
- Track when an order is placed on Magento 2

## Support Us
At the moment, the best way of supporting us it to use this extension and contribute to the issues, bug reports and discussions here at our GitHub repo. 

If you'd like to support us a little more, then you could always...<br><br>
<a href='https://ko-fi.com/hellodamien' target='_blank'><img height='35' style='border:0px;height:46px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=0' border='0' alt='Buy Me a Coffee at ko-fi.com' />
<br><br>

## License

Licensed under the [MIT license](https://github.com/sysentive/magento-2-logsnag/blob/main/README.md).