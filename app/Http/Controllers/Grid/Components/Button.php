<?php

namespace App\Http\Controllers\Grid\Components;

abstract class Button 
{
    private $route;
    private $icon; 
    private $classes;
    private $hasTooltip = false;
    private $tooltip;
    private $usesModal = true;

    public function __construct($route = "", $icon = "", $hasTooltip = false, $tooltip = "", $classes = "btn btn-primary")
    {
        $this->route = route($route);
        $this->icon = $icon;
        $this->classes = $classes;
        $this->hasTooltip = $hasTooltip;
        $this->tooltip = $tooltip;
    }

    /**
     * Get the value of tooltip
     */ 
    public function getTooltip()
    {
        return $this->tooltip;
    }

    /**
     * Set the value of tooltip
     *
     * @return  self
     */ 
    public function setTooltip($tooltip)
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    /**
     * Get the value of classes
     */ 
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Set the value of classes
     *
     * @return  self
     */ 
    public function setClasses($classes)
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Get the value of icon
     */ 
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of icon
     *
     * @return  self
     */ 
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the value of route
     */ 
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set the value of route
     *
     * @return  self
     */ 
    public function setRoute($route)
    {
        $this->route = route($route);

        return $this;
    }

    /**
     * Get the value of hasTooltip
     */ 
    public function getHasTooltip()
    {
        return $this->hasTooltip;
    }

    /**
     * Set the value of hasTooltip
     *
     * @return  self
     */ 
    public function setHasTooltip($hasTooltip)
    {
        $this->hasTooltip = $hasTooltip;

        return $this;
    }

    /**
     * Get the value of usesModal
     */ 
    public function getUsesModal()
    {
        return $this->usesModal;
    }

    /**
     * Set the value of usesModal
     *
     * @return  self
     */ 
    public function setUsesModal($usesModal)
    {
        $this->usesModal = $usesModal;

        return $this;
    }
}
