<?php
namespace main\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use main\AppBundle\DependencyInjection\Compiler\CustomPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

class mainAppBundle extends Bundle
{

    public function build (ContainerBuilder $container)
    {
        parent::build($container);
        //$container->addCompilerPass(new CustomPass(), PassConfig::TYPE_AFTER_REMOVING, 30);
        $container->addCompilerPass(new CustomPass());
    }
}
