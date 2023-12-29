<h1>Membuat aplikasi e-learning menggunakan arsitektur model view controller</h1>

<h1>Cara menjalankannya</h1>
<h2>Sebelum menjalankannya pastikan sudah ada dependencies berikut:</h2>
    <ol>
        <li>
            <p>php versi >= 8</p>
        </li>
        <li>
            <p>MySQL</p>
        </li>
        <li>
            <p>Text Editor</p>
        </li>
        <li>
            <p>Sudah terinstall composer di laptop/pc</p>
        </li>
        <li>
            <p>apache web server (opsional)</p>
        </li>
    </ol>
<h3>Cara Pertama (via php localhost):</h3>
<ol>
    <li>
        <p>Import database elearning.sql dan elearning_test.sql ke mysql </p>
    </li>
    <li>
        <p>Jika sudah berada di direktori, ketik perintah composer update diterminal</p>
    </li>
    <li>
        <p>Jika sudah di update, ketik perintah composer dump-autoload  diterminal</p>
    </li>
    <li>
        <p>Masuk ke direktori public (cd public/)</p>
    </li>
    <li>
        <p>Masukkan perintah php -S localhost:8080 diterminal (jika portnya bentrok ganti ke port lain misalnya 8081)</p>
    </li>
    <li>
        <p>Buka browser dan ketik localhost:8080</p>
    </li>
</ol>

<h3>Cara Kedua (via apache web server) nyusul<h3>

<h1>Framework yang digunakan</h1>
<ol>
    <li><a target="_blank" href="https://phpunit.de/">phpunit</a></li>
</ol>
<h1>Contoh UML</h1>
<h3>Dosen Mengelola Data Nilai Kelompok</h3>
<h4>===Sequence Diagram===</h4>
<img src="./img/contohsequence.png" width="1000px" alt="">
<ol>
    <p>Fungsi dibawah terdapat dibagian DosenController</p>
    <li>
        <p>TampilkanDataKelas() => (merender interface DataKelas yang terdapat didalam folder view)</p>
        <img src="./img/sequence1.jpeg" width="500px" alt="">
    </li>
    <li>
        <p>PilihMenuTambahDataNilaiKelompok()</p>
        <img src="./img/sequence2.jpeg" width="500px" alt="">
    </li>
    <li>
        <p>MenampilkanFormDataNilaiTambahKelompok()</p>
        <img src="./img/sequence4.jpeg" width="500px" alt="">
    </li>
    <li>
        <p>TambahDataNilaiKelompok()</p>
        <img src="./img/sequence5.jpeg" width="500px" alt="">
    </li>
    <li>
        <p>MenampilkanFormDataNilaiEditKelompok()</p>
        <img src="./img/sequence3.jpeg" width="500px" alt="">
    </li>
    <li>
        <p>EditDataNilaiKelompok()</p>
        <img src="./img/sequence6.jpeg" width="500px" alt="">
    </li>
    <li>
        <p>HapusDataNilaiKelompok()</p>
        <img src="./img/sequence7.jpeg" width="500px" alt="">
    </li>
</ol>

<h4>===Class Diagram===</h4>
<img src="./img/class_diagram7.png" width="500px" alt="">
<p>
    Menu Nilai Matakuliah dikelola oleh class KelolaNilaiKelompokService yang mengakses KelolaNilaiKelompokRepository.
    <br>
    1. Berikut fungsi yang terdapat pada class KelolaNilaiKelompokService
    <br>
    <img src="./img/class_diagram3.jpeg" width="500px" alt="">
    <br>
    2. Berikut fungsi yang terdapat pada class KelolaNilaiKelompokRepository
    <br>
    <img src="./img/class_diagram5.jpeg" width="500px" alt="">
</p>
