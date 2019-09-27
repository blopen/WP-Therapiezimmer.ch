<?php

namespace Cubetech\Rendering;

/**
 * A "linked list" of renderable objects to facilitate the management of
 * layout elements
 *
 * @author Marc Mentha <marc.mentha@cubetech.ch>
 * @version 1.2.0
 */
class RenderableList implements IRenderable
{
    
    /**
     * @var IRenderable
     */
    protected $elements;
    
    /**
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->elements = [];
    }
    
    /**
     * Remves an element from the list
     *
     * @param string $name
     * @return void
     * 
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.2.0
     * @version 1.0.0
     */
	public function remove($name)
	{
		foreach($this->elements as $index => $element) {
			if ($element->getName() === $name) {
				unset($this->elements[$index]);
				$this->elements = array_values($this->elements);
			}
		}
	}
    
    /**
     * Appends an item to the End of the List
     *
     * @param string $name
     * @param IRenderable $item
     * @return type
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since Version 1.1.0
     */
    public function append(IRenderable $item)
    {
        $this->elements[] = $item;
    }
    
    /**
     * Checks if this List is empty
     *
     * @return boolean
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function empty()
    {
        return empty($this->elements);
    }
    
    /**
     * Clears all appended items from this List
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function clear()
    {
        $this->elements = [];
    }
    
    /**
     * Render method, implemented from IRenderable
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function render()
    {
        if (count($this->elements) > 0) {
            foreach ($this->elements as $element) {
                $element->render();
            }
        }
        
    }
}