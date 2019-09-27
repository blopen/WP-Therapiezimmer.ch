<?php

namespace Cubetech\Controller;

/**
 * Parent class for all controller
 *
 * @static
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.0
 */
abstract class ABaseController
{
    /**
     * Unified action handling for all controller
     *
     * @return void
     *
     * @abstract
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    abstract public static function addActions();
}