<?php

namespace Klp1\ELearning\Model\Domain;

class Dosen {
    public ?int $id = null;
    public string $userType = "dosen";
    public ?string $nidn = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $name = null;
    public ?string $jurusan = null;
    public ?string $jenisKelamin = null;
    public ?string $email = null;
}

