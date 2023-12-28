<?php

namespace Klp1\ELearning\Model\Domain;

class Admin {
    public ?int $id = null;
    public string $userType = "admin";
    public ?string $username = null;
    public ?string $password = null;
    public ?string $email = null;
}
