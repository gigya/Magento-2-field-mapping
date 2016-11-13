<?php
/**
 * Observer for enriching user data. from Gigya to CMS and vice versa
 */

namespace Gigya\Gigya_FieldMapping\Observer;

use Magento\Framework\Event\ObserverInterface;
use Gigya\Gigya_FieldMapping\Model\M2FieldsUpdater;
use \Magento\Framework\App\Config\ScopeConfigInterface;

class MapFieldsObserver implements ObserverInterface
{

    /**
     * @var Gigya\Gigya_FieldMapping\Model\M2FieldsUpdater
     */
    protected $m2FieldsUpdater;

    /**
     * MapFieldsObserver constructor.
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $config_file_path = $this->scopeConfig->getValue("gigya_section_fieldmapping/general_fieldmapping/mapping_file_path");
        $customer = $observer->getData('customer');
        $gigya_user = $observer->getData('gigya_user');
        $accountManagement = $observer->getData('accountManagement');
        $this->m2FieldsUpdater = new M2FieldsUpdater($gigya_user, $config_file_path);
        $this->m2FieldsUpdater->updateCmsAccount($customer, $accountManagement);
    }
}