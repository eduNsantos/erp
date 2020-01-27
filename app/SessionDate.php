<?php

namespace App;

class SessionDate
{
    private $initialDate;
    private $finalDate;

    public function __construct()
    {
        $this->initialDate = session('date')['initial_date'];
        $this->finalDate = session('date')['final_date'];
    }

    public function getInitialDateSeparetedBy($separator)
    {
        return date('d'.$separator.'m'.$separator.'Y',$this->getInitialDate());
    }

    public function getFinalDateSeparetedBy($separator)
    {
        return date('d'.$separator.'m'.$separator.'Y',$this->getInitialDate());
    }

    /**
     * Get the value of initialDate
     */ 
    public function getInitialDate()
    {
        return $this->initialDate;
    }

    /**
     * Set the value of initialDate
     *
     * @return  self
     */ 
    public function setInitialDate($initialDate)
    {
        $this->initialDate = $initialDate;

        return $this;
    }

    /**
     * Get the value of finalDate
     */ 
    public function getFinalDate()
    {
        return $this->finalDate;
    }

    /**
     * Set the value of finalDate
     *
     * @return  self
     */ 
    public function setFinalDate($finalDate)
    {
        $this->finalDate = $finalDate;

        return $this;
    }
}