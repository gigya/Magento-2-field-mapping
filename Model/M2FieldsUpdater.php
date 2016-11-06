<?php
/**
 * Created by PhpStorm.
 * User: guy.av
 * Date: 27/10/2016
 * Time: 10:27
 */

namespace Gigya\Gigya_FieldMapping\Model;

use Gigya\CmsStarterKit\fieldMapping;

class M2FieldsUpdater extends fieldMapping\CmsUpdater
{

    public function callCmsHook() {
        return true;
    }

    /**
     * @param Magento/Customer $account
     */
    public function setAccountValues(&$account) {
        foreach ($this->getGigyaMapping() as $gigyaName => $confs) { // e.g: loginProvider => [$confItem]
            /** @var Gigya\CmsStarterKit\fieldMapping\ConfItem $conf */
            $value = parent::getValueFromGigyaAccount($gigyaName); // e.g: loginProvider = facebook
            foreach ($confs as $conf) {
                $mageKey = $conf->getMagentoName();
                $value   = $this->castValue($value, $conf);
                $account->setData($mageKey, $value);
            }
        }
    }

    public function saveCmsAccount(&$cmsAccount) {
        return true;
    }

}