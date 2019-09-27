<?php

namespace Cubetech\Rendering;

use \Cubetech\Base\ACFWrapper;
use Cubetech\Base\CubetechPost;
use Cubetech\TemplateLogic\ILogic;

/**
 * Class to provide the functionallity of adding
 * a static template without neccsessary initialize
 * a class.
 * A good example is the head
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class TemplatePart extends ACFWrapper implements IRenderable
{
    use RenderableTrait;
    
    /**
     * Post id of the current page/post
     *
     * @var int
     */
    private $id;
    
    /**
     * Initializes the properties $name and $id
     *
     * @param string $name
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function __construct(string $name, ILogic $logic = null, array $data = [])
    {
        $this->initializeRenderable('template-parts', 'TemplatePart', $name, $logic, $data);
        $this->id = get_the_ID();
        if ($logic !== null) {
            $this->logic = $logic;
            $this->logic->initialize($this->id);
        }
        if ( !empty($data)) {
            $this->data = $data;
        }
    }
    
    /**
     * Returns the name of the TeplatePart
     * Same as the Template name in views/template-parts directory
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Returns the post id we are actually on
     *
     * @return int
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Returns a new CubetechPost using the given $id
     *
     * @param int $id
     * @return CubetechPost|false
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function getPost($id)
    {
        if ($id > 0) {
            return new CubetechPost($id);
        }
        else {
            return false;
        }
    }
    
    /**
     * Checks a field for its validity
     * Inherited from ACFWrapper class
     *
     * @param string $key
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function isFieldValid(string $key)
    {
        $value = $this->getField($key, true);
        return !empty($value);
    }
}