<?php

namespace Cubetech\PageBuilder\Components;

use Cubetech\Cards\NumberCard;
use \Cubetech\Rendering\IStringRenderable;

/**
 * NumberCard component class for pagebuilder
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class NumberCardsComponent extends BaseComponent implements IStringRenderable
{
    
    /**
     * Data for generating the cards
     *
     * @var string
     */
    protected $cardData;
    
    /**
     * Constructor method for this component
     * Initializes the base data for the cards
     *
     * @param int $postId
     * @param int $index
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('NumberCards', $postId, $index, $containerClass);
        for ($i = 1; $i <= 3; $i++) {
            $this->cardData[] = ['title' => $this->getComponentField('card_' . $i . '_title'), 'subtitle' => $this->getComponentField('card_' . $i . '_subtitle')];
        }
        $this->createCards($postId);
    }
    
    /**
     * Creates new NumberCards based on the data prepared in $this->cardData
     *
     * @param int $postId
     * @return type
     */
    private function createCards(int $postId)
    {
        $cards = [];
        foreach ($this->cardData as $cardData) {
            $cards[] = new NumberCard($postId, $cardData['title'], $cardData['subtitle']);
        }
        $this->cards = $cards;
    }
    
    /**
     * Renders all readable contents of this component as a string
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function renderToString()
    {
        $returnString = '';
        foreach ($this->cards as $card) {
            $returnString .= $card->title . ' ';
            $returnString .= $card->subtitle . ' ';
        }
        return $returnString;
    }
    
    /**
     * Validates the component for this particular component
     * Both the cardData must be present as well as the cards property
     * Furthermore the cards property must contain exactly three elements
     *
     * @return boolean
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function isValid()
    {
        if ( !empty($this->cardData) && !empty($this->cards) && count($this->cards) === 3) {
            return true;
        }
        return false;
    }
}