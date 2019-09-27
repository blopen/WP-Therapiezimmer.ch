<?php

namespace Cubetech\Rendering;

/**
 * Interface for all elements with the abillity to render something
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
interface IRenderable
{
    /**
     * Generates the output for an element on the pagek
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function render();
}