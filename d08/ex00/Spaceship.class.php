<?php

class Spaceship implements Doc
{
    private $_player; //имя игрока
    private $_life; //жизнь
    private $_pp; //очки
    private $_speed;
    private $_shield;
    private $_currentLife;
    private $_currentPp;
    private $_currentShield;
    private $_currentRotation;
    private $_sleep;
    private $_currentActive;
    private $_firstTurn;
    private $_currentSpeed;
    private $_step;
    private $_weapons = array();

    public function __construct($_player, $_life, $_pp, $_speed, $_shield, $_currentLife, $_currentPp, $_currentShield, $_currentRotation, $_sleep, $_currentActive, $_firstTurn, $_currentSpeed, $_step, array $_weapons)
    {
        $this->_player = $_player;
        $this->_life = $_life;
        $this->_pp = $_pp;
        $this->_speed = $_speed;
        $this->_shield = $_shield;
        $this->_currentLife = $_currentLife;
        $this->_currentPp = $_currentPp;
        $this->_currentShield = $_currentShield;
        $this->_currentRotation = $_currentRotation;
        $this->_sleep = $_sleep;
        $this->_currentActive = $_currentActive;
        $this->_firstTurn = $_firstTurn;
        $this->_currentSpeed = $_currentSpeed;
        $this->_step = $_step;
        $this->_weapons = $_weapons;
    }

    //смотрит не мешают ли препятствия
    private function moveIsPossible($obstacles)
    {
        foreach ($obstacles as $v) {
            if ($this->_x == $v['x'] && $this->_y == $v['y'])
                return false;
        }
        return true;
    }
    //добавляет щит за счет РР
    public function addShield()
    {
        if ($this->_currentPp > 0) {
            $this->_currentPp = $this->_currentPp - 1;
            $this->_currentShield = $this->_currentShield + 1;
            $this->save();
        }
    }


    // считает кол-во оставщихся щитов и жизни
    public function hit()
    {
        if ($this->_currentShield > 0)
            $this->_currentShield--;
        else
            $this->_currentLife--;
        if ($this->_currentLife <= 0)
            return $this->destroy();
        $this->save();
    }


    //считает скорость
    public function addSpeed()
    {
        if ($this->_currentPp > 0) {
            $this->_currentPp = $this->_currentPp - 1;
            $this->_currentSpeed = $this->_currentSpeed + Dice::roll();
            $this->save();
        }
    }


    public function addCharge()
    {
        //зарядка оружия
    }


    public function destroy()
    {
       //удаляет корабль
    }

    public function save()
    {
        //не знаю, нужна ли эта функция , сохраняет позицию на карте и св-ва коробля(пригодится для charge weapon)
    }

    public function getCurrentRotation()
    {
        return $this->_currentRotation;
    }



    public function getFirstTurn()
    {
        return $this->_firstTurn;
    }

    public function setFirstTurn($firstTurn)
    {
        $this->_firstTurn = $firstTurn;
    }

    public function getCurrentActive()
    {
        return $this->_currentActive;
    }

    public function getCurrentSpeed()
    {
        return $this->_currentSpeed;
    }

    public function getCurrentPp()
    {
        return $this->_currentPp;
    }

    public function getCurrentShield()
    {
        return $this->_currentShield;
    }

    public function getSleep()
    {
        return $this->_sleep;
    }

    public function getPlayer()
    {
        return $this->_player;
    }

    public function getWeapons()
    {
        return $this->_weapons;
    }

    public function getStep()
    {
        return $this->_step;
    }

    public function setStep($step)
    {
        $this->_step = $step;
    }

    public static function doc()
    {
        $read = fopen("Spaceship.doc.txt", 'r');
        while ($read && !feof($read))
            echo fgets($read);
    }
}