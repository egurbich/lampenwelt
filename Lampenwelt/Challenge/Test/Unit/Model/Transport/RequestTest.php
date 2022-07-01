<?php

namespace Lampenwelt\Challenge\Test\Unit\Model\Transport;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    protected $json;
    protected $config;
    protected $logger;
    protected $curlFactory;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->json = $this->createMock(\Magento\Framework\Serialize\Serializer\Json::class);
        $this->config = $this->createMock(\Lampenwelt\Challenge\Model\Config::class);
        $this->logger = $this->createMock(\Psr\Log\LoggerInterface::class);
        $this->curlFactory = $this->createMock(\Magento\Framework\HTTP\Adapter\CurlFactory::class);
    }

    /**
     * @param $requestParams
     * @return void
     */
    public function testRun($requestParams = ['test_key' => 'test_value'])
    {
        $origClass = $this->getOrigClass();
        $this->assertEquals('200', $origClass->run($requestParams));
    }

    /**
     * @return \Lampenwelt\Challenge\Model\Transport\Request
     */
    protected function getOrigClass()
    {
        return new \Lampenwelt\Challenge\Model\Transport\Request(
            $this->json,
            $this->config,
            $this->logger,
            $this->curlFactory
        );
    }
}
