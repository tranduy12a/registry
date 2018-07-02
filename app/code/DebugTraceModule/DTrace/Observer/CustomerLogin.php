<?php

namespace DebugTraceModule\DTrace\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomerLogin implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        echo "Customer LoggedIn";
        echo "success";
        $customer = $observer->getEvent()->getCustomer();
        echo $customer->getName(); //Get customer name

        $item = $observer->getEvent()->getData('quote_item');
        var_dump($item);die;
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $price = $item->getProduct()->getPriceInfo()->getPrice('final_price')->getValue();
        $new_price = $price - ($price * 50 / 100); //discount the price of the product to 50%
        $item->setCustomPrice($new_price);
        $item->setOriginalCustomPrice($new_price);
        $item->getProduct()->setIsSuperMode(true);

        exit;
    }
}