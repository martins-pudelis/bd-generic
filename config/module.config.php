<?php
namespace BdGeneric;

return array(
    'bd_generic_config' => array(
        'email' => 'mach@inbox.lv',
        'name' => 'Base BD',
    ),

    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
