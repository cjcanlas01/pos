<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inventory Entity
 *
 * @property int $inventoryid
 * @property string $productid
 * @property string $sourceid
 * @property string $weight
 * @property string $unitprice
 * @property string $totalinventory
 * @property string $dateissued
 * @property string $userid
 */
class Inventory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'productid' => true,
        'sourceid' => true,
        'weight' => true,
        'unitprice' => true,
        'totalinventory' => true,
        'dateissued' => true,
        'userid' => true
    ];
}
