<?php
/**
 * Created by PhpStorm.
 * User: guy.av
 * Date: 25/10/2016
 * Time: 12:52
 */

namespace Gigya\Gigya_FieldMapping\Observer;

class MapFieldsObserver implements ObserverInterface
{
    public function __construct()
    {
        //Observer initialization code...
        //You can use dependency injection to get any class this observer may need.
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $myEventData = $observer->getData('gigya_user');
        //Additional observer execution code...
    }
}