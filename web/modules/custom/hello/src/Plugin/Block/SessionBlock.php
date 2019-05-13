<?php
/**
 * Created by PhpStorm.
 * User: POE10
 * Date: 30/04/2019
 * Time: 14:04
 */

namespace Drupal\hello\Plugin\Block;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Class SessionBlock
 * @package Drupal\hello\Plugin\Block
 *
 * @Block(
 *  id = "session_block",
 *  admin_label = @Translation("Session!")
 * )
 */
class SessionBlock extends BlockBase
{
    public function build()
    {
        // TODO: Implement build() method.

        $db = \Drupal::database();
        $nbSession = $db -> select('sessions')
                         -> countQuery()
                         -> execute()
                         ->fetchField();

        $build = [
            '#markup' => $this->t('il y a actuellement %nbSession actives',
            ['%nbSession' => $nbSession]),
            '#cache' =>[
                'keys' => ['session:session_block'],
                'max-age' => '0',
            ]
        ];

        return $build;
    }

    protected function blockAccess(AccountInterface $account)
    {

        return AccessResult::allowedIfHasPermission($account, 'access hello');
    }
}