<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sale Entity
 *
 * @property int $salesid
 * @property string $productid
 * @property string $price
 * @property string $weight
 * @property string $amountdue
 * @property string $lessdiscount
 * @property string $netamountdue
 * @property string $amounttender
 * @property string $amountchange
 * @property string $dateissued
 * @property string $timeissued
 * @property string $id
 */
class Sale extends Entity
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
        'price' => true,
        'weight' => true,
        'amountdue' => true,
        'lessdiscount' => true,
        'netamountdue' => true,
        'amounttender' => true,
        'amountchange' => true,
        'dateissued' => true,
        'timeissued' => true,
        'id' => true
    ];
}
