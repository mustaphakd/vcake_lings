<?php
/**
 * Prjct: Vhealings
 * User: musta
 * Date: 5/23/2017
 * Time: 5:44 PM
 */

namespace Wrsft\Model\Entity;


use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * Class EventEntity
 * @package Wrsft\Model\Entity
 *
 * @property string $id
 * @property string $title
 * @property  string $sub_header
 * @property  string description
 * @property \DateTime start_date
 * @property \DateTime end_date
 * @property double $default_cost
 * @property double $min_cost
 * @property int $max_participants
 * @property string $currency
 * @property string $video_path
 * @property string $status
 * @property string $location_id
 */
class EventEntity extends Entity
{
}