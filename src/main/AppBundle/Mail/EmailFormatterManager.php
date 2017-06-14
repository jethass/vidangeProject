<?php
/**
 * Created by IntelliJ IDEA.
 * User: HLATAOUI
 * Date: 01/06/2017
 * Time: 14:52
 */

namespace main\AppBundle\Mail;


class EmailFormatterManager
{
    public function getEnabledFormatters()
    {
        // code to configure which formatters to use
        $enabledFormatters = array('HTMLFormater','XMLFormater');
        return $enabledFormatters;
    }
}