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

    const LOGSNAG_ORDER_DATA_TRIGGERED = 'logsnag_new_order_event_triggered';

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
            $triggered = (bool) $order->getData(self::LOGSNAG_ORDER_DATA_TRIGGERED);

            if ($config['enable'] && $order->getStatus() == $config['order_status_trigger'] && !$triggered) {
                $tags = [
                    'number' => $order->getIncrementId(),
                    'total' => number_format($order->getGrandTotal(), 2, '.', ','),
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

                $order->setData(self::LOGSNAG_ORDER_DATA_TRIGGERED, true)->save();
            }
        } catch (\Exception $e) {
            // Do nothing
        }
    }
}
