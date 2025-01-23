<?php 

abstract class Shape
{
    public abstract function calculateArea();
}

class Rectangle extends Shape
{
    public function __construct(
        private int $width,
        private int $height
    ){}
    public function calculateArea(){
        return $this->width * $this->height;
    }
}

class Square extends Shape
{
    public function __construct(
        private int $side
    ){}
    public function calculateArea(){
        return $this->side ** 2;
    }
}

class Circle extends Shape
{
    const PI = 3.14;
    public function __construct(
        private int $radius
    ){}
    public function calculateArea(){
        return Circle::PI * $this->radius ** 2;
    }
}