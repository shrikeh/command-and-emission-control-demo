<?php
namespace App\ServiceProvider;

use App\Action\Http\CheckBalance;
use Pimple\Container;
use Pimple\Psr11\ServiceLocator;
use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Slim\App;

/**
 * Class ExampleServiceProvider
 * @package App\ServiceProvider
 */
final class ExampleServiceProvider implements ServiceProviderInterface
{
    const APP = 'example.app';
    const INDEX_ACTION = 'example.index_action';
    const RESPONDER = 'example.responder';

    /**
     * @return ServiceLocator
     */
    public static function serviceLocator(): ContainerInterface
    {
        $container = new \Slim\Container();

        $container->register(new self());

        return new ServiceLocator($container, [self::APP]);
    }

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple[self::APP] = function(Container $con) {
            return new App($con);
        };

        $pimple[self::RESPONDER] = function(Container $con) {

        };

        $pimple[self::INDEX_ACTION] = function(Container $con) {
            return new CheckBalance($con[self::RESPONDER]);
        };
    }
}
