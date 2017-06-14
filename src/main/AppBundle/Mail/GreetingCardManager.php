<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 01/06/2017
 * Time: 14:51
 */

namespace main\AppBundle\Mail;


class GreetingCardManager implements  EmailFormatterAwareInterface
{
    private $mailer;
    private $enabledFormatters;
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer=$mailer;
    }

    public function setEnabledFormatters(array $enabledFormatters)
    {
        $this->enabledFormatters = $enabledFormatters;
    }
    

}