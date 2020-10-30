<?php

namespace Drupal\web_subscription\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'SubscriptionBlock' block.
 *
 * @Block(
 *  id = "subscription_block",
 *  admin_label = @Translation("Subscription block"),
 * )
 */
class SubscriptionBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    //    $build = [];
    //    $build['subscription_block']['#markup'] = 'Implement SubscriptionBlock.';

    return \Drupal::formBuilder()
      ->getForm('Drupal\hello\Form\NewsletterForm');
  }

}
