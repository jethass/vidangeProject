<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 30/05/2017
 * Time: 14:00
 */

namespace main\AppBundle\DependencyInjection\Compiler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
//use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\Reference;
use main\AppBundle\Services\ChainedPlaceLocator;

class CustomPass implements CompilerPassInterface
{
    //use PriorityTaggedServiceTrait;
    public function process(ContainerBuilder $container)
    {
        //$locators = $this->findAndSortTaggedServices('place_locator', $container);

        if (!$container->hasDefinition('main.app.chained_locator')) {
            return;
        }

        $definition = $container->findDefinition('main.app.chained_locator');
        $taggedServices = $container->findTaggedServiceIds('place_locator');
        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the ChainTransport service
            $definition->addMethodCall('addLocator', array(new Reference($id)));
        }
    }
}