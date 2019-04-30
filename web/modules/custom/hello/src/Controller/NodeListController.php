<?php
/**
 * Created by PhpStorm.
 * User: POE10
 * Date: 30/04/2019
 * Time: 15:34
 */

namespace Drupal\hello\Controller;


use Drupal\Core\Controller\ControllerBase;

class NodeListController extends ControllerBase
{
    public function nodeContent($nodeType = NULL){

        $storage = $this->entityTypeManager()->getStorage('node');
        $query = $storage->getQuery();
        if ($nodeType){
            $query->condition('type', $nodeType);
        }
        $ids = $query -> pager(10)-> execute();
        $nodes = $storage -> loadMultiple($ids);
        $items = [];
        foreach ($nodes as $node){
            $items[] = $node->toLink();
        }

        $list = [
            '#theme' => 'item_list',
            '#items' => $items,
        ];
        $pager = ['#type' => 'pager'];

        return[
            'list' => $list,
            'pager' => $pager,
            '#cache' => [
                'keys' => ['hello:node_list_controller'],
                'tags' => ['node_list'],
                'contexts' => ['url'],
            ],
        ];
    }
}