<?php

namespace Klp1\ELearning\Model\Domain;

class Matakuliah {
    public string $nama_mk;
    public int $id_mk;
    public ?string $jadwal_mk = null;
    public string $nama_dosen;
    public ?int $sks = null;
}

