<?php

namespace Klp1\ELearning\Model\Domain;

class Admin {
    public ?int $id = null;
    public string $userType = "admin";
    public string $username;
    public string $password;
    public string $email;
}
