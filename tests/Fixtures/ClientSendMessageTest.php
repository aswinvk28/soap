<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DocConfig\Tests\Fixtures;

use DocConfig\SOAP\Core\Client\Client;
use DocConfig\SOAP\Core\Sender\Sender;
use DocConfig\SOAP\Core\Sender\SenderFeatureMediator;

/**
 * Description of ClientSendMessageTest
 *
 * @author Aswin
 */
class ClientSendMessageTest extends \PHPUnit_Framework_TestCase
{
    private $sender;
    
    private $featureManager;
    
    private $config;
    
    private $wsdl;
    
    public function setUp()
    {
        parent::setUp();
        $this->beforeCheckClientConfig();
        $this->beforeCheckSendMessage();
    }
    
    public function beforeCheckClientConfig()
    {
        $this->config = require_once __DIR__ . '../Mock/SOAP/data/config.php';
        unset($this->config['stream_context']);
        unset($this->config['user_agent']);
        unset($this->config['type_map']);
        unset($this->config['classmap']);
        unset($this->config['ssl_method']);
    }
    
    public function checkClientConfig($authType)
    {
        if($authType == 'basic') {
            $this->config['authentication'] = SOAP_AUTHENTICATION_BASIC;
            unset($this->config['authType']);
        } else {
            $this->config['authType'] = $authType;
        }
        
        $assertion_location = file_exists($this->wsdl) || ($this->config['location'] && $this->config['uri']);
        $this->assertNotEmpty($assertion_location, 'The WSDL File or the location and uri are not empty');
    }
    
    public function testClientConfig($authType = 'basic')
    {
        $this->checkClientConfig($authType);
    }
    
    public function checkClientServiceIntegration()
    {
        
    }
    
    public function testClientServiceIntegration()
    {
        
    }
    
    public function beforeCheckSendMessage()
    {
        $this->wsdl = dirname(__DIR__) . '/Mock/SOAP/data/service.wsdl';
    }
    
    public function checkSendMessage()
    {
        $docComment = new DocConfig\SOAP\DocComment;
        
        $this->featureManager = $this->getMockBuilder('DocConfig\SOAP\Feature\FeatureManager')
                ->disableOriginalConstructor()
                ->setMethods(array('getFeature'))
                ->getMock();
        
        $this->featureManager->expects($this->any())
                ->method('getFeature')->with('DocComment')
                ->willReturn($docComment);
        
        $tokenMock = $this->getMockBuilder('DocConfig\SOAP\Authentication\Token\TokenServiceInterface')
                ->setMethods(array('getAccessToken'))
                ->getMock();
        
        $this->featureManager->expects($this->any())
                ->method('getFeature')->with('Token')
                ->willReturn($tokenMock);
    }
    
    public function testSendMessagewithDocComment()
    {
        $this->checkSendMessage();
        
        $clientMediatedEntity = new Client;
        $clientFeatureMediator = SenderFeatureMediatorFactory::createInstance($clientMediatedEntity);
        
        $clientMediatedResult = $clientFeatureMediator->mediate($this->featureManager);
        $this->assertObjectHasAttribute('features', $clientMediatedResult, 'Client has `Features` Attribute');
        
        $this->assertAttributeInternalType('array', 'features', $clientMediatedResult);
        
        $this->assertArrayHasKey('DocComment', $clientMediatedResult->features, 'Features Array of Client Result has `DocComment` Key');
    }
    
    public function testSendMessagewithToken()
    {
        $this->checkSendMessage();
        
        $mediatedEntity = new Sender;
        $senderFeatureMediator = SenderFeatureMediatorFactory::createInstance($mediatedEntity);
        
        $senderMediatedResult = $senderFeatureMediator->mediate($this->featureManager);
        $this->assertObjectHasAttribute('features', $senderMediatedResult, 'Sender has `Features` Attribute');
        
        $this->assertAttributeInternalType('array', 'features', $senderMediatedResult);
        
        $this->assertArrayHasKey('Token', $senderMediatedResult->features, 'Features Array of Sender Result has `Token` Key');
        
        
    }
}
