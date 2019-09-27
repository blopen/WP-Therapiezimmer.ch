<?php

namespace Cubetech\Rendering;
/**
 * Interface for all elements with the abillity to render its
 * content as a string
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
interface IStringRenderable
{
    /**
     * Generates a string of the content of the implementing
     * Object
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function renderToString();
}