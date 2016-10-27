<?php
/**
 * Observer for enriching user data. from Gigya to CMS and vice versa
 */

namespace Gigya\Gigya_FieldMapping\Observer;

use Magento\Framework\Event\ObserverInterface;
use Gigya\Gigya_FieldMapping\Model\M2FieldsUpdater;
//use \Magento\Framework\App\Filesystem\DirectoryList;

class MapFieldsObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
//    protected $directory_list;

    /**
     * @var Gigya\Gigya_FieldMapping\Model\M2FieldsUpdater
     */
    protected $m2FieldsUpdater;

    /**
     * MapFieldsObserver constructor.
     */
    public function __construct(
//        DirectoryList $directory_list
    )
    {
//        $this->directory_list = $directory_list;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $config_file_path = "path/to/config";
        $gigya_user = $observer->getData('gigya_user');
        $customer = $observer->getData('customer');
        $this->m2FieldsUpdater = new M2FieldsUpdater($gigya_user, $config_file_path);
        $test = $this->m2FieldsUpdater->test();
        //Additional observer execution code...
    }
}