<?php

trait HasId{
    protected string $id;
    public function getId(): string{
        return $this->id;
    }
    public function setId($value): void{
        $this->id = $value;
    }
}

class Tester{
    use HasId;
}

$test = new Tester();

$test->setId("abcde");
echo $test->getId();