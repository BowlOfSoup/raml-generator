<?php

namespace Bos\RamlGenerator;

use Bos\RamlGenerator\Model\AbstractApi;
use Bos\RamlGenerator\Model\Api;
use Bos\RamlGenerator\Model\ApiMethod;
use Bos\RamlGenerator\Model\Definition;
use Symfony\Component\Yaml\Yaml;

class ReadRaml
{
    public function deSerialize($file)
    {
        $raml = Yaml::parse(file_get_contents($file));

        $definition = new Definition();
        $apis = array();

        foreach ($raml as $key => $value) {
            if (Definition::TITLE === $key) {
                $definition->setTitle($value);

                continue;
            }
            if (Definition::BASE_URI === $key) {
                $definition->setBaseUri($value);

                continue;
            }
            if (Definition::MEDIA_TYPE === $key) {
                $definition->setMediaType($value);

                continue;
            }
            if (Definition::VERSION === $key) {
                $definition->setVersion($value);

                continue;
            }

            $apis[] = $this->getApi($key, $value);
        }

        var_dump($definition);
        var_dump($apis);
    }

    private function getApi($apiUrl, $methods)
    {
        $api = new Api();
        $api->setUrl($apiUrl);

        foreach ($methods as $key => $value) {
            if (AbstractApi::DESCRIPTION === $key) {
                $api->setDescription($value);

                continue;
            }

            $apiMethod = new ApiMethod();
            if ($apiMethod->isKnownMethod($key)) {
                // known method, fill in objects.
            } else {
                $apiMethodSpecified = new ApiMethod();
                // deeper level
            }
        }

        return $api;
    }
}
