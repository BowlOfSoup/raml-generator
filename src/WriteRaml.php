<?php

namespace Bos\RamlGenerator;

use Bos\RamlGenerator\Model\AbstractApi;
use Bos\RamlGenerator\Model\AbstractApiParameter;
use Bos\RamlGenerator\Model\Definition;
use Symfony\Component\Yaml\Yaml;

class WriteRaml
{
    const RAML_VERSION = '#%RAML 1.0';

    /**
     * @param \Bos\RamlGenerator\Model\Definition $definition
     * @param \Bos\RamlGenerator\Model\Api[] $apis
     *
     * @return string
     */
    public function generate(Definition $definition, array $apis)
    {
        $raml = array(
            Definition::TITLE => $definition->getTitle(),
            Definition::BASE_URI => $definition->getBaseUri(),
            Definition::VERSION => $definition->getVersion(),
            Definition::MEDIA_TYPE => $definition->getMediaType(),
        );

        foreach ($apis as $api) {
            $raml[$api->getUrl()] = array_merge(
                array(AbstractApi::DESCRIPTION => $api->getDescription()),
                $this->getMethods($api->getMethods())
            );
        }

        return Yaml::dump($raml, 6, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
    }

    /**
     * @param string $fileName
     * @param string $output
     */
    public function write($fileName, $output)
    {
        file_put_contents($fileName, static::RAML_VERSION . PHP_EOL . $output);
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiMethod[] $methods
     *
     * @return array
     */
    private function getMethods(array $methods)
    {
        $methodSection = array();

        foreach ($methods as $method) {

            $childMethods = $method->getMethods();
            if (!empty($childMethods)) {
                $methodSection[$method->getMethodName()] = $this->getMethods($childMethods);

                continue;
            }

            $methodSection[$method->getMethodName()][AbstractApi::DESCRIPTION] = $method->getDescription();
            if (!empty($method->getHeaders())) {
                $methodSection[$method->getMethodName()][AbstractApi::HEADERS] = $this->getHeaders($method->getHeaders());
            }
            if (!empty($method->getQueryParameters())) {
                $methodSection[$method->getMethodName()][AbstractApi::QUERY_PARAMETERS] = $this->getQueryParameters($method->getQueryParameters());
            }
            if (!empty($method->getResponses())) {
                $methodSection[$method->getMethodName()][AbstractApi::RESPONSES] = $this->getResponses($method->getResponses());
            }
            if (!empty($method->getBody())) {
                $methodSection[$method->getMethodName()][AbstractApi::BODY] = $method->getBody();
            }
        }

        return $methodSection;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiHeader[] $headers
     *
     * @return array
     */
    private function getHeaders(array $headers)
    {
        $headerSection = array();

        foreach ($headers as $header) {
            $headerSection[$header->getName()] = array(
                AbstractApiParameter::EXAMPLE => $header->getExample()
            );
        }

        return $headerSection;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiQueryParameter[] $queryParameters
     *
     * @return array
     */
    private function getQueryParameters(array $queryParameters)
    {
        $queryParameterSection = array();

        foreach ($queryParameters as $queryParameter) {
            $queryParameterSection[$queryParameter->getName()] = array(
                AbstractApiParameter::EXAMPLE => $queryParameter->getExample()
            );
        }

        return $queryParameterSection;
    }

    /**
     * @param \Bos\RamlGenerator\Model\ApiResponse[] $responses
     *
     * @return array
     */
    private function getResponses(array $responses)
    {
        $responseSection = array();

        foreach ($responses as $response) {
            $responseSection[$response->getStatusCode()] = array($response->getContent() => $response->getExample());
        }

        return $responseSection;
    }
}
