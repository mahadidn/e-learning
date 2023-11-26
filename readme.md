<h1>Membuat aplikasi e-learning menggunakan arsitektur model view controller</h1>
(Untuk dokumentasi menyusul di kemudian hadi)

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
        <p>Buka browser dan ketik localhost:8081</p>
    </li>
</ol>

<h3>Cara Kedua (via apache web server) nyusul<h3>

<h1>Framework yang digunakan</h1>
<ol>
    <li><a href="https://phpunit.de/">phpunit</a></li>
</ol>