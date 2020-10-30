<?php

namespace Drupal\web_subscription;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SubscriptionCounter.
 */
class SubscriptionCounter implements ContainerInjectionInterface {


  /**
   * @var Drupal\Core\Entity\Query\QueryFactory
   *
   * @var Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entityQuery;
  /**
   * Drupal\Core\Entity\EntityManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * SubscriptionCounter constructor.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $entityQuery
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   */
  public function __construct(QueryFactory $entityQuery, EntityManagerInterface $entity_manager) {
    $this->entityQuery = $entityQuery;
    $this->entityManager = $entity_manager;
  }

  public static function create(ContainerInterface $container) {
    // TODO: Implement create() method.
    return new static(
      $container->get('entity.query'),
      $container->get('entity.manager')
    );
  }

  public function subscriptionCount(){
    $storage = $this->entityManager->getStorage('subscription');
    $subscriptionQuery = $storage->getQuery();
    $subscriptionIds = $subscriptionQuery->execute();
    $subscriptions = $storage->loadMultiple($subscriptionIds);


    $rows = [];
    foreach ($subscriptions as $key => $subscription){

      $rows[] = [
        $subscription->id(),
        $subscription->label(),
        $subscription->email->value,
      ];

    }

    $query = $this->entityQuery->get('subscription');
    $results = $query->count()->execute();

    $caption = [
      '#type' => 'html_tag',
      '#tag' => 'h2',
      '#value' => 'Total of '.$results.' subscription(s)'
    ];

    $table = [
      '#type' => 'table',
      '#header' => ['id', 'Name', 'Email'],
      '#rows' => $rows,

    ];

    return[ $caption, $table ];
  }

}
