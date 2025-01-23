<?php
namespace M2i\App\Models;

class User{
    public function __construct(
        private string $userName,
        private array $roles = ["user"]
    ){}

        public function getUsername(): string{
            return $this->userName;
        }
}