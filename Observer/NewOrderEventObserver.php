<?php

namespace Sysentive\LogSnag\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Sysentive\LogSnag\Model\Config\ConfigProvider;
use Sysentive\LogSnag\Helper\LogSnagClient;

class NewOrderEventObserver implements ObserverInterface
{
    protected $logsnag;
    protected $config;
    protected $logSnagClient;
    protected $priceCurrency;

    public function __construct(ConfigProvider $config, LogSnagClient $logSnagClient, PriceCurrencyInterface $priceCurrency)
    {
        $this->config = $config;
        $this->logSnagClient = $logSnagClient;
        $this->priceCurrency = $priceCurrency;
    }

    public function execute(Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();
            $config = $this->config->getNewOrderEventConfig();

            if ($config['enable'] && $order->getStatus() == $config['order_status_trigger']) {
                $tags = [
                    'number' => $order->getIncrementId(),
                    'total' => $order->getGrandTotal(),
                    'email' => $order->getCustomerEmail(),
                    'shipping' => $order->getShippingDescription(),
                    'currency' => $this->priceCurrency->getCurrencySymbol($order->getStoreId())
                ];

                $this->logSnagClient->sendEvent(
                    $config['channel'],
                    $config['event'],
                    $config['description'],
                    $config['icon'],
                    $config['notify'],
                    $tags
                );
            }
        } catch (\Exception $e) {
            // Do nothing
        }
    }
}
