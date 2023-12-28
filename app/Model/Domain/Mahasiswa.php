<?php

namespace Klp1\ELearning\Model\Domain;

class Mahasiswa {
    public ?int $id = null;
    public string $userType = "mahasiswa";
    public ?string $nim = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $nama = null;
    public ?string $email = null;
    public ?string $prodi = null;
    public ?string $jenisKelamin = null;
}
