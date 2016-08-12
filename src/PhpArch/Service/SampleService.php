<?php

namespace PhpArch\Service;

/**
 * Class SampleService
 * @package PhpArch\Service
 */
class SampleService
{
    /**
     * @var string
     */
    private $name = 'SampleService';

    /**
     * Return the name of the service
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}