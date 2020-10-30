<?php

namespace Drupal\web_subscription\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class SubscriptionController.
 */
class SubscriptionController extends ControllerBase {

  /**
   * Displaysubscriptioncount.
   *
   */
  public function displaySubscriptionCount() {
    return \Drupal::service('web_subscription.counter')->subscriptionCount();
  }

  public function revisionOverview() {

  }

  public function revisionShow() {

  }

}
