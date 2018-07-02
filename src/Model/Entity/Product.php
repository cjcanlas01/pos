<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $productid
 * @property string $name
 * @property string $unitprice
 * @property string $weight
 * @property string $inventory
 * @property \Cake\I18n\FrozenTime $date
 * @property string $userid
 * @property string|resource $image
 */
class Product extends Entity
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
        'name' => true,
        'unitprice' => true,
        'weight' => true,
        'inventory' => true,
        'date' => true,
        'userid' => true,
        'image' => true
    ];
}
