<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DocConfig\Tests\Fixtures;

/**
 * Description of DocCommentTest
 *
 * @author Aswin
 */
class DocCommentTest
{
    private $className;
    
    private $docComment;
    
    public function setUp()
    {
        $this->className = 'DocConfig\Tests\Mock\SOAP\DocComment\ServiceClient';
    }
    
    public function testExtractDocComment()
    {
        $reflection = new \ReflectionClass($this->className);
        
        $docComment = $reflection->getDocComment();
        
        $pattern = '^\/\*\*[\n\r\t](([A-za-z]+)\s\=\s(\S))*\*\/$';
        preg_match($pattern, $docComment);
    }
    
    public function testMapWithObjectProperties()
    {
        
    }
    
    public function testDocCommentObject()
    {
        
    }
}
