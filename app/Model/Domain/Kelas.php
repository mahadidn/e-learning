<?php

namespace Klp1\ELearning\Model\Domain;

class Kelas {
    public ?int $id_kelas = null;
    public string $nama_kelas;
    public ?int $id_mk = null;
    public int $kapasitas;
    public ?string $nama_mk;
    public string $nama_dosen;
    public string $matakuliah;
}

