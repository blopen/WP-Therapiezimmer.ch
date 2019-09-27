<?php

namespace Cubetech\Rendering;

/**
 * A "linked list" of renderable objects to facilitate the management of
 * layout elements
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Marc Mentha <marc.mentha@cubetech.ch>
 * @version 1.1.0
 */
class RenderableListElement implements IRenderable
{
    
    /**
     * IRenderable object
     * @var IRenderable
     */
    protected $wrappedObject;
    
    /**
     * @var string
     */
    protected $wrappedObjectName;
    
    /**
     * @var RenderableListElement
     */
    protected $previousElement;
    
    /**
     * @var RenderableListElement
     */
    protected $nextElement;
    
    /**
     * Initializes this list element and its relative
     * position in the entire list
     *
     * @param string $name
     * @param IRenderable $initialRenderable
     * @param RenderableListElement|bool $previous
     * @param RenderableListElement|bool $next
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct($name, IRenderable $initialRenderable, $previous = false, $next = false)
    {
        $this->wrappedObjectName = $name;
        $this->wrappedObject = $initialRenderable;
        $this->previousElement = $previous;
        $this->nextElement = $next;
        if ($this->previousElement instanceof RenderableListElement) {
            $this->previousElement->setNext($this);
        }
        if ($this->nextElement instanceof RenderableListElement) {
            $this->nextElement->setPrevious($this);
        }
    }
    
    /**
     * Insert a new renderable object to the list after the specified item
     *
     * @param string $name
     * @param IRenderable $item
     * @param string $relativeName
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function insert(string $name, IRenderable $item, string $relativeName)
    {
        if ($this->wrappedObjectName !== $relativeName) {
            if ($this->nextElement instanceof RenderableListElement) {
                $this->nextElement->insert($name, $item, $relativeName);
            }
        }
        else {
            if ($item instanceof RenderableListElement) {
                $this->nextElement = $item;
            }
            else {
                $this->nextElement = new RenderableListElement($name, $item, $this, $this->nextElement);
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
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since Version 1.1.0
     */
    public function append(string $name, IRenderable $item)
    {
        if ($this->nextElement === false) {
            $this->nextElement = new RenderableListElement($name, $item, $this);
        }
        else if ($this->nextElement instanceof RenderableListElement) {
            $this->nextElement->append($name, $item);
        }
    }
    
    
    /**
     * Prepend a list element before the element with the $relativeName
     *
     * @param string $name
     * @param IRenderable $item
     * @param string|string $relativeName
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function prepend(string $name, IRenderable $item, string $relativeName = '')
    {
        if ($relativeName === '' && $this->previousElement === false) {
            $this->previousElement = new RenderableListElement($name, $item, false, $this);
        }
        if ($this->wrappedObjectName !== $relativeName) {
            if ($this->nextElement instanceof RenderableListElement) {
                $this->nextElement->prepend($name, $item, $relativeName);
            }
        }
        else {
            if ($item instanceof RenderableListElement) {
                $this->previousElement = $item;
            }
            else {
                $this->previousElement = new RenderableListElement($name, $item, $this->previousElement, $this);
            }
        }
    }
    
    /**
     * Replaces the wrapped renderable object of the named list element
     *
     * @param IRenderable $item
     * @param string $name
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function replace(IRenderable $item, string $name)
    {
        if ($this->wrappedObjectName !== $name) {
            if ($this->nextElement instanceof RenderableListElement) {
                $this->nextElement->replace($item, $name);
            }
        }
        else {
            $this->wrappedObject = $item;
        }
    }
    
    /**
     * Removes the named element from the list
     *
     * @param string $name
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function remove(string $name)
    {
        if ($this->nextElement->getName() === $name) {
            $next_element = $this->nextElement->getNext();
            unset($this->nextElement);
            $this->nextElement = $next_element;
        }
        else {
            $this->nextElement->remove($name);
        }
    }
    
    /**
     * Returns the number of elements in this list
     *
     * @param int $previousCount
     * @return int
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function count($previousCount = 0)
    {
        $previousCount++;
        if ($this->nextElement !== false) {
            return $this->nextElement->count($previousCount);
        }
        return $previousCount;
    }
    
    /**
     * Render method, implemented from IRenderable
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function render()
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<!-- RenderableListElement ' . $this->wrappedObjectName . '::render() -->';
        }
        $this->wrappedObject->render();
        
        if ($this->nextElement !== false) {
            $this->nextElement->render();
        }
    }
    
    /**
     * Manually set the previous element
     * Needed for list mutations
     *
     * @param RenderableListElement $element
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function setPrevious(RenderableListElement $element)
    {
        if ($this->previousElement !== $element) {
            $this->previousElement = $element;
        }
    }
    
    /**
     * Manually set the next element
     * Needed for list mutations
     *
     * @param RenderableListElement $element
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function setNext(RenderableListElement $element)
    {
        if ($this->nextElement !== $element) {
            $this->nextElement = $element;
        }
    }
    
    /**
     * Get the next element
     * Needed for list mutations
     *
     * @return RenderableListElement|bool
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function getNext()
    {
        return $this->nextElement;
    }
    
    /**
     * Get the name of the current wrapped object
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function getName()
    {
        return $this->wrappedObjectName;
    }
}