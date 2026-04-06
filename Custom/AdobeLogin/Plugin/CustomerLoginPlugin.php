<?php
namespace Custom\AdobeLogin\Plugin;

use Magento\Customer\Model\AccountManagement;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class CustomerLoginPlugin
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeAuthenticate(AccountManagement $subject, $username, $password)
    {
        $allowedDomains = ['@adobe.com', '@gmail.com'];
        $isValid = false;

        foreach ($allowedDomains as $domain) {
            if (substr($username, -strlen($domain)) === $domain) {
                $isValid = true;
                break;
            }
        }

        if (!$isValid) {
            $this->logger->error('Invalid login attempt with email: ' . $username);
            throw new LocalizedException(__('You can only login using an adobe.com or gmail.com email.'));
        }

        $this->logger->info('Valid login attempt: ' . $username);
        return [$username, $password];
    }
}
