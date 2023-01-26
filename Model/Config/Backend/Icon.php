<?php

namespace Sysentive\LogSnag\Model\Config\Backend;

class Icon extends \Magento\Framework\App\Config\Value
{
    /**
     * @return $this
     */
    public function beforeSave()
    {
        $value = $this->getValue();
        $this->setValue(json_encode($value));
        return parent::beforeSave();
    }

    /**
     * @return mixed
     */
    public function afterLoad()
    {
        $value = $this->getValue();
        $this->setValue(json_decode($value, true));
        return parent::afterLoad();
    }
}