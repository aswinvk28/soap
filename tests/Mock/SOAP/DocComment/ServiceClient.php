<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DocConfig\Tests\Mock\SOAP\DocComment;

/**
 * Description of ServiceClient
 *
 * @author Aswin
 */
class ServiceClient
{
    /**
     *
     * wsdl = '../../service/service.wsdl'
     * options = { 
     *   encoding: 'ISO-8859-1',
     *   keep_alive: 'true'
     * }
     */
    private $client1;
    
    /**
     *
     * wsdl = '../../service/service.wsdl'
     * options = {
     *   encoding = 'utf8',
     *   keep_alive = 'false'
     * }
     */
    private $client2;
    
    /**
     * 
     */
    public function executeMethod()
    {
       $cpv = $this->client1->getCPVforCPVCode('3500000000', 0);
       $cpvDivision = $this->client2->getAllCPVforDivision('35');
    }
}
