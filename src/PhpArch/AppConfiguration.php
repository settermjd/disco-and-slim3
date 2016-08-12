<?php

namespace PhpArch;

use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Annotations\Parameter;
use bitExpert\Disco\Annotations\Parameters;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Slim\CallableResolver;
use Slim\Handlers\Error;
use Slim\Handlers\NotAllowed;
use Slim\Handlers\NotFound;
use Slim\Handlers\PhpError;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;
use Slim\Views\PhpRenderer;
use Doctrine\Common\Annotations\Annotation;

/**
 * @Configuration
 */
class AppConfiguration
{
    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return PhpRenderer
     */
    public function renderer($settings = [])
    {
        $rendererSettings = $settings['renderer'];

        return new PhpRenderer($rendererSettings['template_path']);
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Logger
     */
    public function logger($settings = [])
    {
        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);
        $logger->pushProcessor(new UidProcessor());
        $logger->pushHandler(
            new StreamHandler(
                $loggerSettings['path'],
                Logger::DEBUG
            )
        );

        return $logger;
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Router
     */
    public function router($settings = [])
    {
        return new Router();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Environment
     */
    public function environment($settings = [])
    {
        return new Environment();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Request
     */
    public function request($settings = [])
    {
        return new Request();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Response
     */
    public function response($settings = [])
    {
        return new Response();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return array
     */
    public function settings()
    {
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return PhpError
     */
    public function phpErrorHandler()
    {
        return new PhpError();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Error
     */
    public function errorHandler()
    {
        return new Error();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return Error
     */
    public function foundHandler()
    {
        return new Error();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @param array|\Traversable $settings
     * @return NotFound
     */
    public function notFoundHandler()
    {
        return new NotFound();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @param array|\Traversable $settings
     * @return array
     */
    public function notAllowedHandler()
    {
        return new NotAllowed();
    }

    /**
     * @Bean({"singleton"=true, "lazy"=true, "scope"="request"})
     * @Parameters({
     *     @Parameter({"name" = "settings"})
     * })
     * @param array|\Traversable $settings
     * @return CallableResolver
     */
    public function callableResolver()
    {
        return new CallableResolver();
    }
}
