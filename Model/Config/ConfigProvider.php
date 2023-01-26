<?php

declare(strict_types=1);

namespace Sysentive\LogSnag\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigProvider
{
  const LOGSNAG_API_TOKEN = 'logsnag/api/token';
  const LOGSNAG_API_PROJECT = 'logsnag/api/project';

  const LOGSNAG_ORDER_PLACED_ENABLE = 'logsnag/new_order_event/enable';
  const LOGSNAG_ORDER_PLACED_ICON = 'logsnag/new_order_event/icon';
  const LOGSNAG_ORDER_PLACED_CHANNEL = 'logsnag/new_order_event/channel';
  const LOGSNAG_ORDER_PLACED_DESCRIPTION = 'logsnag/new_order_event/description';
  const LOGSNAG_ORDER_PLACED_EVENT = 'logsnag/new_order_event/event';
  const LOGSNAG_ORDER_PLACED_ORDER_STATUS_TRIGGER = 'logsnag/new_order_event/order_status_trigger';
  const LOGSNAG_ORDER_PLACED_NOTIFY = 'logsnag/new_order_event/notify';

  /**
   * @var ScopeConfigInterface
   */
  private $scopeConfig;

  /**
   * ConfigProvider constructor.
   * @param ScopeConfigInterface $scopeConfig
   */
  public function __construct(ScopeConfigInterface $scopeConfig)
  {
    $this->scopeConfig = $scopeConfig;
  }

  /**
   * Get Api
   *
   * @return string
   */
  public function getApiToken(): string
  {
    return (string) $this->scopeConfig->getValue(
      self::LOGSNAG_API_TOKEN,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );
  }

  public function getApiProject(): string
  {
    return (string) $this->scopeConfig->getValue(
      self::LOGSNAG_API_PROJECT,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );
  }

  public function getNewOrderEventConfig(): array
  {
    $enable = (bool) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_ENABLE,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    $channel = (string) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_CHANNEL,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    $description = (string) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_DESCRIPTION,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    $event = (string) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_EVENT,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    $icon = (string) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_ICON,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    $orderStatusTrigger = (string) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_ORDER_STATUS_TRIGGER,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    $notify = (bool) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_NOTIFY,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );

    return [
      'enable' => $enable,
      'order_status_trigger' => $orderStatusTrigger,
      'channel' => $channel,
      'description' => $description,
      'event' => $event,
      'icon' => json_decode($icon),
      'notify' => $notify
    ];
  }
}
