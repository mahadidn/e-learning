<?php

namespace Klp1\ELearning\Repository;

use Klp1\ELearning\Model\Domain\Admin;
use Klp1\ELearning\Model\Domain\Dosen;
use Klp1\ELearning\Model\Domain\Mahasiswa;
use Klp1\ELearning\Model\Domain\SessionAdmin;
use Klp1\ELearning\Model\Domain\SessionDosen;
use Klp1\ELearning\Model\Domain\SessionMahasiswa;

class LoginRepository {
    private \PDO $connection;

    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }

    // login
    public function findByUsername(string $username): Admin|Dosen|Mahasiswa|null {

        $statementAdmin = $this->connection->prepare("SELECT id, username, password, email FROM admin WHERE username = ?");
        $statementAdmin->execute([$username]);

        $statementDosen = $this->connection->prepare("SELECT id, nidn, username, password, nama, jenis_kelamin, email, prodi  FROM dosen WHERE username = ?");
        $statementDosen->execute([$username]);

        $statementMahasiswa = $this->connection->prepare("SELECT id, nim, username, password, nama, email, prodi, jenis_kelamin FROM mahasiswa WHERE username = ? ");
        $statementMahasiswa->execute([$username]);

        try {
            if ($row = $statementAdmin->fetch()){
                $admin = new Admin();
                $admin->username = $row['username'];
                $admin->password = $row['password'];
                $admin->email = $row['email'];
                $admin->id = $row['id'];
                return $admin;
            }else if($row = $statementDosen->fetch()){
                $dosen = new Dosen();
                $dosen->username = $row['username'];
                $dosen->nidn = $row['nidn'];
                $dosen->password = $row['password'];
                $dosen->name = $row['nama'];
                $dosen->email = $row['email'];
                $dosen->jurusan = $row['prodi'];
                $dosen->jenisKelamin = $row['jenis_kelamin'];
                $dosen->id = $row['id'];
                return $dosen;
            }else if ($row = $statementMahasiswa->fetch()){
                $mahasiswa = new Mahasiswa();
                $mahasiswa->username = $row['username'];
                $mahasiswa->nim = $row['nim'];
                $mahasiswa->password = $row['password'];
                $mahasiswa->nama = $row['nama'];
                $mahasiswa->email = $row['email'];
                $mahasiswa->prodi = $row['prodi'];
                $mahasiswa->jenisKelamin = $row['jenis_kelamin'];
                $mahasiswa->id = $row['id'];
                return $mahasiswa;
            }else {
                return null;
            }
        }finally {
            $statementAdmin->closeCursor();
            $statementDosen->closeCursor();
            $statementMahasiswa->closeCursor();
        }

    }

    // createsession
    public function createSession(SessionAdmin|SessionMahasiswa|SessionDosen $session): SessionAdmin|SessionMahasiswa|SessionDosen{
        if ($session->userType == "admin"){
            $statementAdmin = $this->connection->prepare("INSERT INTO session_admin(id, username_session, user_id) VALUES (?, ?, ?)");
            $statementAdmin->execute([$session->id, $session->usernameSession, $session->userId]);
            $session->userType = "admin";

            return $session;
        }else if($session->userType == "dosen"){
            $statementDosen = $this->connection->prepare("INSERT INTO session_dosen(id, username_session, user_id) VALUES (?, ?, ?)");
            $statementDosen->execute([$session->id, $session->usernameSession, $session->userId]);
            $session->userType = "dosen";

            return $session;
        }else if ($session->userType == "mahasiswa"){
            $statementMahasiswa = $this->connection->prepare("INSERT INTO session_mahasiswa(id, username_session, user_id) VALUES (?, ?, ?)");
            $statementMahasiswa->execute([$session->id, $session->usernameSession, $session->userId]);
            $session->userType = "mahasiswa";

            return $session;
        }
    }

    public function findByUserId(string $userId): SessionAdmin|SessionMahasiswa|SessionDosen|null {
        $statementAdmin = $this->connection->prepare("SELECT id, username_session, user_id FROM session_admin WHERE user_id = ?");
        $statementAdmin->execute([$userId]);

        $statementDosen = $this->connection->prepare("SELECT id, username_session, user_id FROM session_dosen WHERE user_id = ?");
        $statementDosen->execute([$userId]);

        $statementMahasiswa = $this->connection->prepare("SELECT id, username_session, user_id FROM session_mahasiswa WHERE user_id = ?");
        $statementMahasiswa->execute([$userId]);

        try {
            if($row = $statementAdmin->fetch()){
                $session = new SessionAdmin();
                $session->userType = "admin";
                $session->usernameSession = $row['username_session'];
                $session->userId = $row['user_id'];
                $session->id = $row['id'];

                return $session;
            }
            if ($row = $statementDosen->fetch()){
                $session = new SessionDosen();
                $session->userType = "dosen";
                $session->usernameSession = $row['username_session'];
                $session->userId = $row['user_id'];
                $session->id = $row['id'];

                return $session;
            }
            if ($row = $statementMahasiswa->fetch()){
                $session = new SessionMahasiswa();
                $session->userType = "mahasiswa";
                $session->usernameSession = $row['username_session'];
                $session->userId = $row['user_id'];
                $session->id = $row['id'];

                return $session;
            }else {
                return null;
            }
        }finally {
            $statementAdmin->closeCursor();
            $statementDosen->closeCursor();
            $statementMahasiswa->closeCursor();
        }
    }

    public function findBySession(string $usertype, int $id): Admin|Mahasiswa|Dosen|null {

        if ($usertype == "admin"){
            $statementAdmin = $this->connection->prepare("SELECT id, username, password, email FROM admin WHERE id = ?");
            $statementAdmin->execute([$id]);
        }
        if ($usertype == "dosen"){
            $statementDosen = $this->connection->prepare("SELECT id, nidn, username, password, nama, jenis_kelamin, email, prodi  FROM dosen WHERE id = ?");
            $statementDosen->execute([$id]);
        }
        if ($usertype == "mahasiswa"){
            $statementMahasiswa = $this->connection->prepare("SELECT id, nim, username, password, nama, email, prodi, jenis_kelamin FROM mahasiswa WHERE id = ? ");
            $statementMahasiswa->execute([$id]);
        }

        try {

            if ($usertype == "admin"){
                $row = $statementAdmin->fetch();
                $admin = new Admin();
                $admin->username = $row['username'];
                $admin->password = $row['password'];
                $admin->email = $row['email'];
                $admin->id = $row['id'];
                return $admin;
            }else if($usertype == "dosen"){
                $row = $statementDosen->fetch();
                $dosen = new Dosen();
                $dosen->username = $row['username'];
                $dosen->nidn = $row['nidn'];
                $dosen->password = $row['password'];
                $dosen->name = $row['nama'];
                $dosen->email = $row['email'];
                $dosen->jurusan = $row['prodi'];
                $dosen->jenisKelamin = $row['jenis_kelamin'];
                $dosen->id = $row['id'];
                return $dosen;
            }else if ($usertype == "mahasiswa"){
                $row = $statementMahasiswa->fetch();
                $mahasiswa = new Mahasiswa();
                $mahasiswa->username = $row['username'];
                $mahasiswa->nim = $row['nim'];
                $mahasiswa->password = $row['password'];
                $mahasiswa->nama = $row['nama'];
                $mahasiswa->email = $row['email'];
                $mahasiswa->prodi = $row['prodi'];
                $mahasiswa->jenisKelamin = $row['jenis_kelamin'];
                $mahasiswa->id = $row['id'];
                return $mahasiswa;
            }else {
                return null;
            }
        }finally {
            if ($usertype == "admin"){
                $statementAdmin->closeCursor();
            }
            if ($usertype == "dosen"){
                $statementDosen->closeCursor();
            }
            if ($usertype == "mahasiswa"){
                $statementMahasiswa->closeCursor();
            }
        }

    }

    
    public function deleteByUserId(string $userId): void {
        $result = $this->findByUserId($userId);

        if($result->userType == "admin"){
            $statementAdmin = $this->connection->prepare("DELETE FROM session_admin WHERE user_id = ?");
            $statementAdmin->execute([$userId]);
        }else if($result->userType == "dosen"){
            $statementDosen = $this->connection->prepare("DELETE FROM session_dosen WHERE user_id = ?");
            $statementDosen->execute([$userId]);
        }else if ($result->userType == "mahasiswa"){
            $statementMahasiswa = $this->connection->prepare("DELETE FROM session_mahasiswa WHERE user_id = ?");
            $statementMahasiswa->execute([$userId]);
        }

    }

    public function deleteAll(): void {
        $this->connection->exec("DELETE FROM session_admin");
        $this->connection->exec("DELETE FROM session_dosen");
        $this->connection->exec("DELETE FROM session_mahasiswa");
    }

}
