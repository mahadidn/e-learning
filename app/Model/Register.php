<?php

namespace Klp1\ELearning\Model;

class Register {
    public ?int $id = null;
    public ?string $namaLengkap = null;
    public ?string $jenisKelamin = null;
    public string $username;
    public ?string $nim = null;
    public ?string $nidn = null;
    public string $email;
    public ?string $jurusan = null;
    public string $password;
    public string $konfirmasiPassword;

}

