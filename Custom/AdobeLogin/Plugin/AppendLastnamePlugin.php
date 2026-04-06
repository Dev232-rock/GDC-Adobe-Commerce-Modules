<?php
namespace Custom\AdobeLogin\Plugin;

use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Api\Data\CustomerInterface;

class AppendLastnamePlugin
{
    public function beforeCreateAccount(AccountManagement $subject, CustomerInterface $customer, $password = null, $redirectUrl = '')
    {
        $lastname = $customer->getLastname();
        if (strpos($lastname, 'Adobe') === false) {
            $customer->setLastname($lastname . ' Adobe');
        }

        return [$customer, $password, $redirectUrl];
    }
}
