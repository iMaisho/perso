<?php

class Door{
    private bool $opened = false;
    private bool $locked = false;


    public function open() :void{
        if (!$this->opened && !$this->locked){
            $this->opened = true;
        }
    }
    public function close() :void{
        if ($this->opened){
            $this->opened = false;
        }
    }

    public function lock() :void{
        if (!$this->opened && !$this->locked){
            $this->locked = true;
        }
    }

    public function unlock() :void{
        if ($this->locked){
            $this->locked = false;
        }
    }
    public function isOpened() :bool{
        return $this->opened;
    }
    public function isLocked() :bool{
        return $this->locked;
    }
}


