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
        $queryResults = $db->select('hello_user_statistics', 'h')
            ->fields('h',['action', 'time'])
            ->condition('uid', $user->id())
            ->execute();

        $rows = [];

        foreach ($queryResults as $record){
            $rows[] = [
                $record->action == '1' ? $this->t('Login') : $this->t('Logout'),
                \Drupal::service('date.formatter')->format($record->time)];

        }

        return [
            '#type' => 'table',
            '#header' => [$this->t('Action'), $this->t('Time')],
            '#rows' => $rows,
        ];

    }
}