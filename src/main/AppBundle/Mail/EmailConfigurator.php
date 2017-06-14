<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 01/06/2017
 * Time: 14:54
 */

namespace main\AppBundle\Mail;
use main\AppBundle\Mail\EmailFormatterManager;

class EmailConfigurator
{
    private $formatterManager;

    public function __construct(EmailFormatterManager $formatterManager)
    {
        $this->formatterManager = $formatterManager;
    }

    public function configure(EmailFormatterAwareInterface $emailManager)
    {
        $emailManager->setEnabledFormatters(
            $this->formatterManager->getEnabledFormatters()
        );
    }
}