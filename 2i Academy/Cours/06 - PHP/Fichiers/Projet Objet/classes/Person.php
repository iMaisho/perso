<?php 

class Person
{
    private string $firstName;
    private string $lastName;
    public function __construct(string $firstName, string $lastName)
        {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        }
    public function getGreeting(): string
    {
        return "Bonjour mon nom est {$this->firstName} {$this->lastName}";
    }
}

class Student extends Person
{
    private string $schoolName;
    public function __construct(string $firstName, string $lastName, string $schoolName) {
        parent::__construct($firstName, $lastName);
        $this->schoolName = $schoolName;
    }

    public function getGreeting(): string
    {
        return parent::getGreeting(). "et j'étudie dans cette école : {$this->schoolName}";
    }
}
