<?php

namespace Drupal\hello\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;


class EventBase extends RouteSubscriberBase
{

    protected function alterRoutes(RouteCollection $collection) {
        // TODO: Implement alterRoutes() method.
//        ksm($collection);
        $route= $collection->get('entity.user.canonical');
        $route->setRequirements(['_access_hello'=>'10']);
    }
}