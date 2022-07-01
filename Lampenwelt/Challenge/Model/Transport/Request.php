<?php
declare(strict_types=1);

namespace Lampenwelt\Challenge\Model\Transport;

use Lampenwelt\Challenge\Model\Config;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;
use Magento\Framework\HTTP\Adapter\CurlFactory;

/**
 * Class Request. Sending data to ERP
 */
class Request
{
    const REQUEST_TYPE_POST = "POST";
    const HTTP_VERSION = '1.1';

    /**
     * @var Json
     */
    protected $json;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var CurlFactory
     */
    protected $curlFactory;

    /**
     * @param LoggerInterface $logger
     * @param Json $json
     * @param Config $config
     * @param CurlFactory $curlFactory
     */
    public function __construct(
        LoggerInterface $logger,
        Json $json,
        Config $config,
        CurlFactory $curlFactory
    ) {
        $this->logger = $logger;
        $this->json = $json;
        $this->config = $config;
        $this->curlFactory = $curlFactory;
    }

    /**
     * Main request to ERP API
     * We can add API Key or API Login and API password
     *
     * @param $requestParams
     * @return string|void|null
     */
    public function run($requestParams)
    {
        // checking if the module enabled
        if (!$this->config->isEnabled()) {
            return null;
        }

        if ($requestParams != null) {
            try {
                $apiUrl = $this->config->getAPIUrl();
                /**
                 * @var \Magento\Framework\HTTP\Adapter\Curl $http
                 */
                $http = $this->curlFactory->create();
                $headers = [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ];
                $body = $this->json->serialize($requestParams);
                $http->write(
                    self::REQUEST_TYPE_POST,
                    $apiUrl,
                    self::HTTP_VERSION,
                    $headers,
                    $body
                );

                // $response = $http->read(); In case of using real response
                $response = $this->config->getResponse();
                return $response;
            }
            catch (\Exception $e) {
                $this->logger->error($e);
            }
        } else {
            $this->logger->error('ERP Error: API request parameters are empty');
        }
    }
}
