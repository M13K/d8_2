<?php
/**
 * Created by PhpStorm.
 * User: POE10
 * Date: 29/04/2019
 * Time: 16:26
 */
namespace Drupal\hello\Plugin\Block;

/**
 * Class HelloBlock
 * @Block(
 *  id = "Hello_block",
 *  admin_label = @Translation("Hello!")
 * )
 */

class HelloBlock extends \Drupal\Core\Block\BlockBase
{
    /**
     * @return array|void
     */
    public function build()
    {
        // TODO: Implement build() method.

        $date = \Drupal::service('datetime.time')->getCurrentTime();
        $formatter = \Drupal::service('date.formatter');
        $user = \Drupal::currentUser()->getDisplayName();

        $dateformatted = $formatter->format($date, 'custom', 'H:i s\s');
        $build = array('#markup' => $this->t('Welcome %user on our site it\'s %dateformatted',
            ['%dateformatted' => $dateformatted,
                '%user' => $user]),
            '#cache' => [
                'keys' => ['hello:hello_block'],
                'contexts' => ['user'],
            ],
            );

        return $build;
    }
}