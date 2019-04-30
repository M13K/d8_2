<?php
/**
 * Created by PhpStorm.
 * User: POE10
 * Date: 29/04/2019
 * Time: 14:34
 */

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase
{
    public function helloContent($param=''){
        $user = $this->currentUser();
        return ['#markup' => $this->t('Hello %name you are on the hello page and your param is %param' ,
           [
             '%name' => $user->getDisplayName(),
             '%param' => $param,
           ]
        )];
    }

}
