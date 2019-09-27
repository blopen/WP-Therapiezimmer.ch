<?php

namespace Cubetech\Packages;

/**
 * Interface for theme packages
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @version 1.0.0
 */
interface IPackage
{
    
    /**
     * Run method to start executing the specific package
     *
     * @return void
     * @author Alex Scherer
     * @since 1.0.0
     */
    public function run();
    
}