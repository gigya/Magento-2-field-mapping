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

    public function test() {
        return true;
    }

    public function callCmsHook() {
        return true;
    }

    public function saveCmsAccount(&$cmsAccount) {
        return true;
    }

    public function setAccountValues(&$account) {
        return true;
    }

}