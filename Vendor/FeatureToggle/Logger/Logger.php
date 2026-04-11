<?php
namespace Vendor\FeatureToggle\Logger;

class Logger extends \Monolog\Logger
{
    public function __construct()
    {
        parent::__construct('featuretoggle'); 
    }
}