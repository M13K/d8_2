<?php
/**
 * Created by PhpStorm.
 * User: POE10
 * Date: 02/05/2019
 * Time: 14:49
 */

namespace Drupal\hello\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class UserStatisticsController extends ControllerBase
{
    public function userStatistics(UserInterface $user) {
        $db = \Drupal::database();
        $query = $db->select('hello_user_statistics')
            ->fields(['action'])
            ->execute()
            ->fetchField();
        $build = [
            '#table' =>[
                'query'=>$query
            ]
        ];

        return $build;

    }
}