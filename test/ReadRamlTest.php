<?php

namespace Bos\RamlGenerator\Test;

use Bos\RamlGenerator\ReadRaml;

class ReadRamlTest extends \PHPUnit_Framework_TestCase
{
    public function testReadRaml()
    {
        $readRaml = new ReadRaml();
        $api = $readRaml->deSerialize(__DIR__ . '/assets/WriteRamlTestGenerate.raml');
    }
}
