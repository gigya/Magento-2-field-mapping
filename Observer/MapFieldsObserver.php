<?php
/**
 * Observer for enriching user data. from Gigya to CMS and vice versa
 */

namespace Gigya\Gigya_FieldMapping\Observer;

use Magento\Framework\Event\ObserverInterface;
use Gigya\Gigya_FieldMapping\Model\M2FieldsUpdater;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Gigya\GigyaIM\Logger\Logger;

class MapFieldsObserver implements ObserverInterface
{

    /**
     * @var Gigya\Gigya_FieldMapping\Model\M2FieldsUpdater
     */
    protected $m2FieldsUpdater;

    protected $_logger;

    /**
     * MapFieldsObserver constructor.
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        Logger $logger
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->_logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $config_file_path = $this->scopeConfig->getValue("gigya_section_fieldmapping/general_fieldmapping/mapping_file_path");
        if (!is_null($config_file_path)) {
            $customer = $observer->getData('customer');
            $gigya_user = $observer->getData('gigya_user');
            $accountManagement = $observer->getData('accountManagement');
            $this->m2FieldsUpdater = new M2FieldsUpdater($gigya_user, $config_file_path);
            $this->m2FieldsUpdater->setGigyaLogger($this->_logger);
            try {
                $this->m2FieldsUpdater->updateCmsAccount($customer, $accountManagement);
            } catch (\Exception $e) {
                $this->gigyaLog(
                    "error " . $e->getCode() . ". message: " . $e->getMessage() . ". File: " .$e->getFile(),
                    __CLASS__ , __FUNCTION__
                );
            }
        } else {
            $this->gigyaLog(
                "mapping fields file path is not defined. Define file path at: Stores:Config:Gigya:Field Mapping",
                __CLASS__ , __FUNCTION__
            );
        }
    }

    protected function gigyaLog($message, $class, $method) {
        $this->_logger->warning(
            $message,
            array( "class" => $class,  "method" => $method )
        );
    }
}