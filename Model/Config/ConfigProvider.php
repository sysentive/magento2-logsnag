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
  const LOGSNAG_ORDER_PLACED_PARSER = 'logsnag/new_order_event/parser';

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
    return (string) $this->getDefaultValue(
      self::LOGSNAG_API_TOKEN,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );
  }

  public function getApiProject(): string
  {
    return (string) $this->getDefaultValue(
      self::LOGSNAG_API_PROJECT
    );
  }

  public function getNewOrderEventConfig(): array
  {
    $enable = (bool) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_ENABLE
    );

    $channel = (string) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_CHANNEL
    );

    $description = (string) $this->scopeConfig->getValue(
      self::LOGSNAG_ORDER_PLACED_DESCRIPTION
    );

    $event = (string) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_EVENT
    );

    $icon = (string) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_ICON
    );

    $orderStatusTrigger = (string) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_ORDER_STATUS_TRIGGER
    );

    $notify = (bool) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_NOTIFY
    );

    $parser = (string) $this->getDefaultValue(
      self::LOGSNAG_ORDER_PLACED_PARSER
    );

    return [
      'enable' => $enable,
      'order_status_trigger' => $orderStatusTrigger,
      'channel' => $channel,
      'description' => $description,
      'event' => $event,
      'icon' => json_decode($icon),
      'notify' => $notify,
      'parser' => $parser,
    ];
  }

  public function getDefaultValue($path)
  {
    return $this->scopeConfig->getValue(
      $path,
      ScopeConfigInterface::SCOPE_TYPE_DEFAULT
    );
  }
}
