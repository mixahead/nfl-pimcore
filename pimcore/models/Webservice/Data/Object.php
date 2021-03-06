<?php
/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @category   Pimcore
 * @package    Webservice
 * @copyright  Copyright (c) 2009-2013 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Webservice_Data_Object extends Webservice_Data {


    /** If set to true then null values will not be exported.
     * @var
     */
    protected static $dropNullValues;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $parentId;

    /**
     * @var string
     */
    public $key;

    /**
     * @var bool
     */
    public $published;

    /**
     * @var string
     */
    public $type;

    /**
     * @var integer
     */
    public $userOwner;


    /**
     * @var Webservice_Data_Property[]
     */
    public $properties;

    public function map ($object) {

        parent::map($object);

        $keys = get_object_vars($this);
        if(array_key_exists("childs",$keys)){
            if($object->hasChilds()) {
                $this->childs = array();
                foreach ($object->getChilds() as $child) {
                    $item = new Webservice_Data_Object_List_Item();
                    $item->id = $child->getId();
                    $item->type = $child->getType();
                    $this->childs[] = $item;
                }
            }
        }

    }

    /**
     * @param  $dropNullValues
     */
    public static function setDropNullValues($dropNullValues)
    {
        self::$dropNullValues = $dropNullValues;
    }

    /**
     * @return
     */
    public static function getDropNullValues()
    {
        return self::$dropNullValues;
    }




}
