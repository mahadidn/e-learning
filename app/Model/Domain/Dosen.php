<?php

namespace Klp1\ELearning\Model\Domain;

class Dosen {
    public ?int $id = null;
    public string $userType = "dosen";
    public string $nidn;
    public string $username;
    public string $password;
    public string $name;
    public string $jurusan;
    public string $jenisKelamin;
    public string $email;
}

