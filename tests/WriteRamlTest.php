<?php

namespace Bos\RamlGenerator\Tests;

use Bos\RamlGenerator\Model\Api;
use Bos\RamlGenerator\Model\ApiHeader;
use Bos\RamlGenerator\Model\ApiMethod;
use Bos\RamlGenerator\Model\ApiQueryParameter;
use Bos\RamlGenerator\Model\ApiResponse;
use Bos\RamlGenerator\Model\Definition;
use Bos\RamlGenerator\WriteRaml;

class WriteRamlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @testdox Write full GET output.
     */
    public function testGenerate()
    {
        $definition = new Definition();
        $definition->setTitle('Test API');
        $definition->setBaseUri('api/v2');

        $api = new Api();
        $api->setUrl('/quotes');
        $api->setDescription('Collection of quotes.');

        $apiMethodGet = new ApiMethod();
        $apiMethodGet->setDescription('Get a list of quotes based on filter parameters.');
        $apiMethodGet->setMethodName('get');
        $headerGet = new ApiHeader();
        $headerGet->setName('X-Access-Token');
        $headerGet->setExample('user:password');
        $apiMethodGet->addHeader($headerGet);
        $queryParameterGet = new ApiQueryParameter();
        $queryParameterGet->setName('random');
        $queryParameterGet->setExample('?random=1');
        $apiMethodGet->addQueryParameter($queryParameterGet);
        $responseGet = new ApiResponse();
        $responseGet->setStatusCode(200);
        $responseGet->setExample($this->getJson());
        $apiMethodGet->addResponse($responseGet);
        $api->addMethod($apiMethodGet);

        $apiMethodPost = new ApiMethod();
        $apiMethodPost->setMethodName('post');
        $apiMethodPost->setDescription('Create a quote.');
        $apiMethodPost->setBody($this->getJson());
        $api->addMethod($apiMethodPost);

        $apiMethodQuoteId = new ApiMethod();
        $apiMethodQuoteId->setMethodName('/(quoteId)');

        $apiMethodQuoteIdDelete = new ApiMethod();
        $apiMethodQuoteIdDelete->setMethodName('delete');
        $apiMethodQuoteIdDelete->setDescription('Delete a quote.');

        $apiMethodQuoteId->addMethod($apiMethodQuoteIdDelete);

        $api->addMethod($apiMethodQuoteId);

        $writeRaml = new WriteRaml();

        $actual = $writeRaml->generate($definition, array($api));
        $expected = file_get_contents(__DIR__ . '/assets/WriteRamlTestGenerate.raml');

        $this->assertSame($actual, $expected);
    }

    /**
     * @return string
     */
    private function getJson()
    {
        return '{"context": "Woensdag bugfixdag","datetime": "2007-04-17 17:31:36","kudos": {"person": "Jan Jansen"},"person": "Jan Jansen","quote": "Ja sorry, ik ben standaard elke woensdag ziek","user": "1"}';
    }
}
