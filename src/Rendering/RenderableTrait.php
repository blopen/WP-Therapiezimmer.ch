<?php

namespace Cubetech\Rendering;

use Cubetech\TemplateLogic\ILogic;

/**
 * Trait implementing the functionality of IRenderable and generating the view path
 * out of the name and category of the implementing class
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
trait RenderableTrait
{
    /**
     * Holds the base path of the attached view
     *
     * @var string
     */
    protected $viewPath;
    
    /**
     * Holds the name of the implementing part
     *
     * @var string
     */
    protected $name;
    
    /**
     * Holds the type of the implementing part, used mainly for debugging
     *
     * @var string
     */
    protected $type;
    
    /**
     * Holds the attached Logic object
     *
     * @var Cubetech\TemplateLogic\ILogic
     */
    protected $logic;
    
    /**
     * Holds an array with additional data provided to the included view
     *
     * @var array
     */
    protected $data;
    
    /**
     * Initializes the trait with any data needed to provide its functionality
     *
     * @param string $category
     * @param string $type
     * @param string $name
     * @param ILogic $logic
     * @param array $data
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initializeRenderable(string $category, string $type, string $name, ILogic $logic = null, array $data = [])
    {
        $this->viewPath = get_template_directory() . '/views/';
        if ( !empty($category)) {
            $this->viewPath .= $category . '/';
        }
        if ( !empty($type)) {
            $this->type = $type;
        }
        else {
            $this->type = 'Undefined';
        }
        if ( !empty($name)) {
            $this->name = $name;
        }
        else {
            $this->name = 'Undefined';
        }
        $this->logic = $logic;
        $this->data = $data;
    }
    
    
    /**
     * Provides any public properties of this instance's logic module or any
     * elements of the data array inside this instance's context
     *
     * @param string $name
     * @return mixed
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function __get($name)
    {
        if (isset($this->logic->$name)) {
            return $this->logic->$name;
        }
        else if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }
    
    /**
     * Provides any public methods of this instance's logic module inside
     * this instance's context
     *
     * @param string $function
     * @param array $parameters
     * @return mixed
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function __call($function, $parameters)
    {
        if (empty($this->logic)) {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log(print_r(__CLASS__, 1));
                error_log('Tried to call method ' . $function . ' of a LogicModule, when it is not defined');
            }
            return;
        }
        if (empty($parameters)) {
            return $this->logic->$function();
        }
        else {
            return call_user_func_array([$this->logic, $function], $parameters);
        }
    }
    
    /**
     * Renders the view attached to this instance
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    final public function render()
    {
        if ( !empty($this->logic)) {
            $this->logic->beforeRender();
        }
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<!-- BEGIN ' . $this->type . ' ' . $this->name . ' -->';
        }
        if (file_exists($this->viewPath . $this->name . '.php')) {
            include $this->viewPath . $this->name . '.php';
        }
        else {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                echo '<p class="uk-text-danger uk-text-bold uk-text-center">Template: ' . $this->name . '.php not found in ' . $this->viewPath . '</p>';
            }
        }
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<!-- END ' . $this->type . ' ' . $this->name . ' -->';
        }
        if ( !empty($this->logic)) {
            $this->logic->afterRender();
        }
    }
}