<?php

namespace Cubetech\PageBuilder\Components;

use \Cubetech\Controller\StyleController;

/**
 * Map component class for pagebuilder
 *
 * @author Nelson Lopez <nelson.lopez@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class MapComponent extends BaseComponent
{
    
    /**
     * Title of this component
     * Generated from ACF singleline field
     *
     * @var string
     */
    protected $title;
    
    /**
     * Longitude of map field
     * Generated from ACF singleline field
     *
     * @var string
     */
    protected $longitude;
    
    /**
     * Latitude of map field
     * Generated from ACF singleline field
     *
     * @var string
     */
    protected $latitude;
    
    /**
     * Was an uniq_id generate by PHP in the MapComponent.php
     *
     * @var int
     */
    protected $mapId;
    /**
     * Get if Map has tow columns
     *
     * @var bool
     */
    protected $isTwoColumn;
    /**
     *Wysiwyg Editor whit Information of the coordinate
     *
     *
     * @var element whit string
     */
    protected $mapText;
    /**
     * Get if Map has tow alignment to left or right
     *
     * @var bool
     */
    protected $mapAlignment;
    
    
    /**
     * Constructor for Map Component
     *
     * If longitude and altitude are set this component is valid
     * Initialising the value of the Map Object
     *
     * @param $postId , $index, $containerClass;
     * @return void
     * @version 1.0.0
     *
     * @author Nelson Lopez
     * @since 1.0.1
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('Map', $postId, $index, $containerClass);
        $this->title = $this->getComponentField('map_title');
        $this->longitude = $this->getComponentField('map_longitude');
        $this->latitude = $this->getComponentField('map_latitude');
        $this->isTwoColumn = $this->getComponentField('map_is_tow_column');
        $this->mapText = $this->getComponentField('map_text');
        $this->mapAlignment = $this->getComponentField('map_alignment');
        $this->mapId = uniqid();
    }
    
    /**
     * Validates the component
     *
     * If longitude and altitude are set this component is valid
     *
     * @return boolean
     *
     * @author Nelson Lopez
     * @since 1.0.1
     * @version 1.0.0
     */
    public function isValid()
    {
        if ($this->longitude && $this->latitude) {
            return true;
        }
        return false;
    }
}