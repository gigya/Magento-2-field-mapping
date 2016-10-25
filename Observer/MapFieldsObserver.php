<?php
/**
 * Observer for enriching user data before
 */

namespace Gigya\Gigya_FieldMapping\Observer;

use Magento\Framework\Event\ObserverInterface;

class MapFieldsObserver implements ObserverInterface
{
    public function __construct()
    {
        //Observer initialization code...
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $gigya_user = $observer->getData('gigya_user');
        $customer = $observer->getData('customer');
        //Additional observer execution code...
    }
}