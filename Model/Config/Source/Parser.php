<?php

namespace Sysentive\LogSnag\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;;

class Parser implements OptionSourceInterface
{
  /**
   * @return array
   */
  public function toOptionArray()
  {
    return [
      ['value' => 'text', 'label' => 'text'],
      ['value' => 'markdown', 'label' => 'markdown'],
    ];
  }
}
