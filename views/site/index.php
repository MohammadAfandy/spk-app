<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <center>
        <h3>SISTEM PENDUKUNG KEPUTUSAN</h3>
        <p class="lead">Aplikasi Sistem Pendukung Keputusan Menggunakan Metode SAW dan WP</p>
    </center>
    <div id="accordion" class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#collapse_spk">1. Sistem Pendukung Keputusan</a>
                </h4>
            </div>
            <div id="collapse_spk" class="panel-collapse collapse">
                <div class="panel-body" style="text-align: justify;"">
                    <p>
                        Sistem Pendukung Keputusan (SPK) atau Decision Support System (DSS) menurut Harry Waluya (1997: 102), didefinisikan sebagai suatu peralatan komputer yang terintegrasi yang memungkinkan bagi pengambilan keputusan (decision maker) untuk berintegrasi langsung dengan komputer dalam menciptakan informasi yang berguna dalam membuat keputusan baik yang bersifat terstruktur maupun yang tidak terstruktur.
                    </p>
                    <p>
                        Menurut Alter dalam Kusrini (2007: 15), sistem pendukung keputusan (SPK) merupakan sistem informasi interaktif yang menyediakan informasi, pemodelan, dan pemanipulasian data. Sistem itu digunakan untuk membantu pengambilan keputusan dalam situasi yang semi terstruktur dan situasi yang tidak terstruktur, dimana tak seorang pun tahu secara pasti bagaimana keputusan seharusnya dibuat.<a href="http://lib.unnes.ac.id/20684/1/5302411055-S.pdf" target="_blank">http://lib.unnes.ac.id/20684/1/5302411055-S.pdf</a>
                    </p>
                    <p>
                        Sistem Pendukung Keputusan merupakan suatu sistem interaktif yang mendukung keputusan dalam proses pengambilan keputusan melalui alternatif–alternatif yang diperoleh dari hasil pengolahan data, informasi dan rancangan model. Dari pengertian sistem pendukung keputusan maka dapat ditentukan karakteristik antara lain :
                        <ol>
                            <li>Mendukung proses pengambilan keputusan, menitikberatkan pada management by perception.</li>
                            <li>Adanya interface manusia / mesin dimana manusia (user) memegang control proses pengambilan keputusan.</li>
                                <li>Mendukung pengambilan keputusan untuk membahas masalah terstruktur, semi terstruktur dan tak struktur.</li>
                                <li>Memiliki kapasitas dialog untuk memperoleh informasi sesuai dengan kebutuhan.</li>
                                <li>Memiliki subsistem – subsistem yang terintegrasi sedemikian rupa sehingga dapat berfungsi sebagai kesatuan item.</li>
                                <li>Membutuhkan struktur data komprehensif yang dapat melayani kebutuhan informasi seluruh tingkatan manajemen.</li>
                        </ol>
                        <a href="https://eprints.dinus.ac.id/15172/1/jurnal_14778.pdf" target="_blank">https://eprints.dinus.ac.id/15172/1/jurnal_14778.pdf</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse_saw">2. SAW (Simple Additive Weighting)</a>
            </h4>
        </div>
        <div id="collapse_saw" class="panel-collapse collapse">
            <div class="panel-body" style="text-align: justify;">
                <p>
                    Konsep dasar metode Simple Additive Weighting adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif pada semua atribut (Fishburn, 1967) (MacCrimmon, 1968).
                    <a href="http://ojs.unpkediri.ac.id/index.php/intensif/article/view/839/581" target="_blank">http://ojs.unpkediri.ac.id/index.php/intensif/article/view/839/581</a>
                </p>
                <p>
                    Dalam Kusumadewi, dkk (2006: 74) Simple Additive Weighting (SAW) dikenal dengan istilah metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja setiap alternatif pada semua atribut. Metode SAW membutuhkan proses normalisasi matriks keputusan (X) ke suatu skala yang dapat diperbandingkan dengan semua rating .
                </p>
                <p>
                    Langkah-langkah penyelesaian dengan metode SAW
                    <ol class="langkah">
                        <li>Menentukan alternative, yaitu Ai</li>
                        <li>Menentukan kriteria yang akan dijadikan acuan dalam pengambilan keputusan, yaitu Cj</li>
                        <li>Memberikan nilai rating kecocokan setiap alternative pada setiap kriteria</li>
                        <li>Menentukan bobot preferensi atau tingkat kepentingan (W) setiap kriteria W=[W1 W2 W3 Wi]</li>
                        <li>Membuat table rating kecocokan dari setiap alternative pada setiap kriteria </li>
                        <li>
                            Membuat matrik keputusan yang dibentuk dari table rating kecocokan dari setiap alternative pada setiap kriteria nilai setiap alternative (Ai) pada setiap kriteria (Cj) yang sudah ditentukan,dimana i=1,2 m dan j=1,2,..n<br><?= Html::img('@web/images/saw-1.png') ?>
                        </li>
                        <li>
                            Melakukan normalisasi matrik keputusan dengan cara menghitung nilai rating kinerja ternomalisasi (rij) dari alternative Ai pada kriteria Cj<br>
                            Rumus:
                            <ol type="a">
                                <li>Jika j adalah keuntungan (Benefit) <?= Html::img('@web/images/saw-2.png') ?></li>
                                <li>Jika j adalah biaya (Cost)  <?= Html::img('@web/images/saw-3.png') ?></li>
                                Vi = rangking untuk setiap alternative<br> 
                                Wj = nilai bobot dari setiap kriteria<br>
                                Rij = nilai rating kinerja ternormalisasi<br>
                                Nilai Vi yang lebih besar mengindikasikan bahwa akternatif Ai lebih terpilih<br>
                            </ol>
                            Keterangan:
                            <ol type="a">
                                <li>Dikatakan kriteria keuntungan apabila nilai memberikan keuntungan bagi pengambil keputusan, sebaliknya kriteria biaya apabila menimbulkan biaya bagi pengambil keputusan</li>
                                <li>Apabila berupa kriteria keuntungan maka nilai dibagi dengan nilai dari setiap kolom, sedangkan untuk kriteria biaya dari setiap kolom dibagi dengan nilai.</li>
                            </ol>
                        </li>
                        <li>Hasil dari nilai rating kerja ternormalisasi (rij) membentuk matrik ternormalisasi<br><?= Html::img('@web/images/saw-4.png') ?></li>
                        <li> Hasil akhir dari preferensi (Vi) diperoleh dari penjumlahan dari perkalian elemen baris matrik ternormalisasi (R) dengan bobot preferensi (W) yang bersesuai elemen kolom matrik (W)<br><?= Html::img('@web/images/saw-5.png') ?></li>
                    </ol>
                    <strong>Hasil perhitungan nilai Vi yang lebih besar mengidentifikasikan bahwa alternative Ai merupakan alternative terbaik (Kusumadewi, 2006)</strong>
                </p>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse_wp">3. WP (Weighted Product)</a>
            </h4>
        </div>
        <div id="collapse_wp" class="panel-collapse collapse">
            <div class="panel-body" style="text-align: justify;">
                <p>
                    Metode Weighted Product (WP) adalah salah satu metode penyelesaian pada sistem pendukung keputusan. Metode ini mengevaluasi beberapa alternatif terhadap sekumpulan atribuat atau kriteria, dimana setiap atribut saling tidak bergantung satu dengan yang lainnya.
                </p>
                <p>
                    Menurut Yoon (dalam buku Kusumadewi, 2006), metode weighted product menggunakan teknik perkalian untuk menghubungkan rating atribut, dimana rating tiap atribut harus dipangkatkan terlebih dahulu dengan bobot atribut yang bersangkutan.
                </p>
                <p>
                    Langkah-langkah penyelesaian menggunakkan metode WP adalah sebagai berikut:
                    <ol class="langkah">
                        <li>Menentukan kriteria-kriteria yang akan dijadikan acuan dalam pengambilan keputusan, yaitu Ci dan sifat dari masing-masing kriteria.</li>
                        <li>Menentukan rating kecocokan setiap alternatif pada setiap kriteria, dan buat matriks keputusan.</li>
                        <li>Melakukan normalisasi bobot. Bobot Ternormalisasi = Bobot setiap kriterian / penjumlahan semua bobot kriteria.<br>Nilai dari total bobot harus memenuhi persamaan <?= Html::img('@web/images/wp-1.jpg') ?></li>
                        <li>
                            Menentukan nilai vektor S<br>
                            Dengan cara mengalikan seluruh kriteria bagi sebuah alternatif dengan bobot sebagai pangkat positif untuk kriteria benefit dan bobot berfungsi sebagai pangkat negatif pada kriteria cost.<br>
                            Rumus untuk menghitung nilai preferensi untuk alternatif Ai, diberikan sebagai berikut:<br>
                            <?= Html::img('@web/images/wp-2.jpg') ?><br>
                            Keterangan:
                            <ul type="square">
                                <li>S : menyatakan preferensi alternatif yang dianalogikan sebagai vektor S</li>
                                <li>x : menyatakan nilai kriteria</li>
                                <li>w : menyatakan bobot kriteria</li>
                                <li>i : menyatakan alternatif</li>
                                <li>j : menyatakan kriteria</li>
                                <li>n : menyatakan banyaknya kriteria</li>
                            </ul>
                        </li>
                        <li>
                            Menentukan nilai vektor V<br>
                            Yaitu nilai yang akan digunakan untuk perangkingan.<br>
                            Nilai preferensi relatif dari setiap alternatif dapat dihitung dengan rumus:<br>
                            <?= Html::img('@web/images/wp-3.jpg') ?><br>
                            Keterangan:<br>
                            <ul type="square">
                                <li>V : menyatakan preferensi alternatif yang dianalogikan sebagai vektor V</li>
                                <li>x : menyatakan nilai kriteria</li>
                                <li>w : menyatakan bobot kriteria</li>
                                <li>i : menyatakan alternatif</li>
                                <li>j : menyatakan kriteria</li>
                                <li>n : menyatakan banyaknya kriteria</li>
                            </ul>
                        </li>
                        <li>Merangkingan Nilai Vektor V</li>
                    </ol>
                </p>
            </div>
        </div>
    </div>
</div>
