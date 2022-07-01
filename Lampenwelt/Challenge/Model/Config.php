<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config. Getting most of the data from the module's configuration
 */
class Config
{
    const SETTING_IS_ENABLED = 'lampenwelt/general/enabled';
    const SETTING_API_LOGIN = 'lampenwelt/general/api_login';
    const SETTING_API_PASSWORD = 'lampenwelt/general/api_password';
    const SETTING_API_URL = 'lampenwelt/general/api_url';
    const SETTING_SUCCESS_FLAG = 'lampenwelt/general/success';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isEnabled() : bool
    {
        return $this->scopeConfig->isSetFlag(self::SETTING_IS_ENABLED);
    }

    /**
     * @return string
     */
    public function getAPIUrl() : string
    {
        return $this->scopeConfig->getValue(self::SETTING_API_URL);
    }

    /**
     * @return string
     */
    public function apiLogin() : string
    {
        return $this->scopeConfig->getValue(self::SETTING_API_LOGIN);
    }

    /**
     * @return string
     */
    public function apiPassword() : string
    {
        return $this->scopeConfig->getValue(self::SETTING_API_PASSWORD);
    }

    /**
     * @return bool
     */
    public function successFlag() : bool
    {
        return $this->scopeConfig->isSetFlag(self::SETTING_SUCCESS_FLAG);
    }

    /**
     * @return string
     */
    public function getResponse() : string
    {
        return $this->successFlag() === true ? '200' : '500';
    }
}
