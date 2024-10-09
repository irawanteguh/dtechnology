<div class="modal fade" id="modal-edituser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Perbaharui Data Karyawan</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/tilaka/registrasi/edituser" id="formedituser">
                <input type="hidden" id="userid-edit" name="userid-edit">
                <div class="modal-body">
                    <div class="text-start mb-5">
                        <div class="text-muted fw-bold fs-5">Silakan memperbaharui data karyawan</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 row">
                            <div class="col-md-2">
                                <div class="col-md-12 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span>Avatar</span>
                                    </label>
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?php echo base_url()?>assets/images/avatars/blank.png)">
                                        <?php                                            
                                            if($_SESSION['imgprofile']==="Y"){
                                                $imageUrl = base_url() . "assets/images/avatars/".$_SESSION['userid'].".jpeg";
                                            }else{
                                                $imageUrl = base_url() . "assets/images/avatars/blank.png";
                                            }
                                            echo "<div class='image-input-wrapper w-125px h-125px' style='background-image: url(".$imageUrl.")'></div>";
                                        ?>

                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="avatar" id="avatar" accept=".jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-10 row">
                                <div class="col-md-12 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">NIK Rumah Sakit</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="nikrs-edit" name="nikrs-edit" readonly>
                                </div>                                  
                                <div class="col-md-6 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Nama Karyawan</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="namakaryawan-edit" name="namakaryawan-edit" readonly>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Nama Sesuai KTP</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan masukan nama sesuai KTP"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" id="namaktp-edit" name="namaktp-edit">
                                </div>  
                                <div class="col-md-4 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Nomor Kartu Tanda Penduduk</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan no KTP anda yang aktif"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Silakan Masukan Nomor KTP" id="noktp-edit" name="noktp-edit" minlength="16" maxlength="16" required>
                                    <span class="fs-9 text-muted">Nomor Kartu Tanda Penduduk Maksimal 16 Digit</span>
                                </div>                                
                                <div class="col-md-8 mb-5">
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Email Address</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Silakan alamat email anda yang aktif"></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid form-control-sm" placeholder="Silakan Masukan Alamat Email Anda" id="email-edit" name="email-edit" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-form-label" for="filektp">Upload KTP</label>
                            <div class="dropzone" id="file_doc">
                                <div class="dz-message needsclick">
                                    <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 12.6L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L8 12.6H11V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18V12.6H16Z" fill="black" />
                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                        </svg>
                                    </span>
                                    <div class="ms-4">
                                        <h3 class="dfs-3 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                        <span class="fw-bold fs-8 text-muted">File Document Dalam Format .Jpeg</span><br>
                                        <span class="fw-bold fs-8 text-muted">Max File Size 2 Mb</span>
                                    </div>
                                </div>
                            </div>   
                        </div>                                          
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="btnproses" type="submit" value="PERBAHARUI DATA" name="simpan" >			
                </div>  
            </form>  
        </div>
    </div>
</div>

<div class="modal fade" id="modal-registerusertilaka" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h1 class="mb-3">Registrasi User Tilaka</h1>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/tilaka/registrasi/registrasiuser" id="formregisteruser">
                <input type="hidden" id="userid-registrasi" name="userid-registrasi">
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-11">
                            <h3 class="text-center">SYARAT & KETENTUAN LAYANAN TILAKA</h3>
                            <br>
                            <h5>Selamat datang di Layanan TILAKA!</h5>
                            <p class="text-xs" style="text-align: justify;">
                                Dengan ini, <b>PT Tilaka Nusa Teknologi</b> (“PSrE TILAKA” atau “Kami”) ingin menyampaikan bahwa  selaku pemilik dan pengelola dari Layanan Tanda Tangan Elektronik yang dapat digunakan baik dengan mengakses secara langsung melalui URL: <a href="https://corporate.tilaka.id/ca-corporate-portal/login.xhtml">https://corporate.tilaka.id/ca-corporate-portal/login.xhtml</a> atau melalui aplikasi yang dibuat, dikelola, dikembangkan, atau dimiliki oleh <?php $_SESSION['hospitalname']?> (“Layanan TILAKA”) memiliki syarat dan ketentuan (“S&K”) yang harus Pemilik dan/atau Pemohon (“Anda”) setujui sebelum menggunakan Layanan TILAKA. Anda berkewajiban untuk membaca, memahami, dan menyetujui isi dari S&K ini sebelum melakukan melakukan permohonan penerbitan, permohonan penerbitan ulang, permohonan penggantian kunci, menerima, dan/atau menggunakan Sertifikat Pemilik (“Mengakses Layanan TILAKA”). Dalam hal Anda tidak menyetujui sebagian atau seluruh ketentuan yang diatur dalam S&K ini, maka Anda tidak diperkenankan untuk Mengakses Layanan TILAKA.
                                S&K ini berlaku efektif setelah ditampilkan pada salah satu halaman pada Layanan TILAKA saat Anda mengajukan permohonan penerbitan, permohonan penerbitan ulang, dan/atau permohonan penggantian kunci Sertifikat Pemilik. Atas permohonan permohonan penerbitan, permohonan penerbitan ulang, permohonan penggantian kunci Sertifikat Pemilik yang dilakukan setelah S&K ini berlaku efektif, maka ketentuan pada S&K ini berlaku untuk Pemilik.
                                Anda dengan ini mengetahui, mengerti, dan menyetujui bahwa S&K ini merupakan Dokumen Elektronik dan tindakan Anda memberikan tanda “centang” saat permohonan permohonan penerbitan, permohonan penerbitan ulang, dan/atau permohonan penggantian kunci Sertifikat Pemilik merupakan persetujuan Anda secara aktif untuk mengikatkan diri dan tunduk pada ketentuan yang terdapat pada S&K ini. Oleh karena itu, S&K ini telah berlaku sah dan mengikat Anda secara hukum dan terus berlaku sepanjang anda Mengakses Layanan TILAKA.
                            </p>
                            <br>
                            <h5>Definisi</h5>
                            <ol class="text-xs" style="text-align: justify;">
                                <li>Akun adalah suatu kode alfanumerik yang diterbitkan oleh PSrE TILAKA yang berfungsi untuk mengidentifikasi Anda dalam menggunakan Layanan TILAKA.</li>
                                <li>Data Pribadi adalah data tentang orang perseorangan yang teridentifikasi atau dapat diidentifikasi secara tersendiri atau dikombinasi dengan informasi lainnya baik secara langsung maupun tidak langsung melalui sistem elektronik atau nonelektronik.</li>
                                <li>Dokumen Elektronik adalah setiap Informasi Elektronik yang dibuat, diteruskan, dikirimkan, diterima, atau disimpan dalam bentuk analog, digital, elektromagnetik, optikal, atau sejenisnya, yang dapat dilihat, ditampilkan dan/atau didengar melalui komputer atau sistem elektronik, termasuk atau sistem elektronik, termasuk tetapi tidak terbatas pada tulisan, suara, gambar, peta, rancangan, foto atau sejenisnya, huruf, tanda, angka, kode akses, simbol atau perforasi yang memiliki makna atau arti atau dapat dipahami oleh orang yang mampu memahaminya.</li>
                                <li>Hari Kalender adalah semua hari dalam satu tahun sesuai kalender gregorius tanpa kecuali termasuk hari Sabtu, Minggu, dan hari libur nasional yang ditetapkan sewaktu-waktu oleh Pemerintah.</li>
                                <li>Kontrak Elektronik adalah Perjanjian yang dibuat melalui sistem elektronik.</li>
                                <li>Pemilik adalah Warga Negara Indonesia yang berada dalam ruang lingkup Pelanggan dan merupakan subjek dari Sertifikat Pemilik.</li>
                                <li>Pemohon adalah Warga Negara Indonesia yang berada dalam ruang lingkup Pelanggan yang mengajukan permohonan penerbitan atau penerbitan ulang atau penggantian kunci Sertifikat dalam ruang lingkup Pelanggan. Setelah Sertifikat diterbitkan, Pemohon disebut sebagai Pemilik.</li>
                                <li>Pelanggan adalah Korporasi atau Personal yang berlangganan Layanan TILAKA.</li>
                                <li><b>PT Tilaka Nusa Teknologi</b> (“PSrE TILAKA”) adalah PSrE dengan status pengakuan berinduk yang Sertifikatnya telah ditandatangani oleh PSrE Induk.</li>
                                <li>Repositori Tilaka adalah suatu halaman pada website PSrE TILAKA yang berisi semua dokumen publik milik PSrE TILAKA, yang dapat diakses melalui <a href="https://repository.tilaka.id/">https://repository.tilaka.id/</a>.</li>
                                <li>Sertifikat adalah Sertifikat yang bersifat elektronik yang memuat tanda tangan elektronik dan identitas yang menunjukkan status subjek hukum para pihak dalam transaksi elektronik.</li>
                                <li>Sertifikat Pemilik adalah Sertifikat yang diterbitkan oleh PSrE TILAKA.</li>
                            </ol>
                            <br>
                            <h5>Ketentuan Bagi Anda</h5>
                            <ol class="text-xs" style="text-align: justify;">
                                <li>Anda setuju untuk Mengakses Layanan TILAKA hanya untuk tujuan sebagaimana ditentukan dalam S&K ini dan daftar Dokumen Publik sebagaimana disebutkan dalam S&K ini. Anda dengan ini menjamin untuk tidak akan menggunakan Layanan TILAKA untuk tujuan penipuan, menyebabkan ketidaknyamanan kepada orang lain, atau melakukan tindakan lainnya yang dapat atau dianggap dapat menimbulkan kerugian dalam bentuk apapun terhadap orang atau badan hukum lainnya.</li>
                                <li>Dalam rangka menggunakan Layanan TILAKA, Anda akan memiliki Akun yang hanya boleh digunakan oleh Anda dan tidak dapat dialihkan kepada orang lain dengan alasan ataupun keadaan apapun. Maka dari itu, Anda berkewajiban untuk menjaga kerahasiaan nama Akun dan kata sandi yang akan digunakan sehubungan dengan penggunaan Layanan TILAKA.</li>
                                <li>Anda setuju untuk memberikan semua informasi dan/atau Data Pribadi yang diminta oleh PSrE TILAKA  dengan disertai dengan dokumen pendukung yang dibutuhkan sehubungan dengan kegiatan Mengakses Layanan TILAKA.</li>
                                <li>Anda setuju bahwa PSrE TILAKA berhak untuk melakukan verifikasi secara independen terhadap semua informasi dan/atau Data Pribadi sesuai dengan prosedur yang berlaku pada PSrE TILAKA.</li>
                                <li>Anda dengan ini menjamin bahwa segala informasi dan/atau Data Pribadi  yang disampaikan kepada TILAKA sehubungan dengan kegiatan Mengakses Layanan TILAKA adalah benar, jelas, akurat dan lengkap. Anda berkewajiban untuk menginformasikan kepada PSrE TILAKA dalam hal terdapat perubahan, penambahan, atau pembaruan atas informasi dan/atau Data Pribadi. PSrE TILAKA berhak untuk menolak permohonan penerbitan Sertifikat Pemilik, menolak penerbitan ulang Sertifikat Pemilik, menolak permohonan penggantian kunci Sertifikat Pemilik,  dan/atau menolak melakukan perubahan, penambahan, atau pembaruan atas informasi dan/atau Data Pribadi yang tersimpan pada Layanan TILAKA, jika ditemukan atau patut diduga bahwa informasi dan/atau Data Pribadi yang diberikan oleh Anda tidak sesuai dengan ketentuan S&K ini dan Dokumen Publik sebagaimana disebutkan dalam S&K ini.</li>
                                <li>
                                    Anda setuju atas isi yang tercantum dalam Sertifikat Pemilik yang diterbitkan oleh PSrE TILAKA baik dari proses permohonan penerbitan, permohonan penerbitan ulang, dan/atau permohonan penggantian kunci Sertifikat Pemilik dalam hal:
                                    <ul>
                                        <li>Anda telah memeriksa dan menyetujui informasi yang terkandung dalam Sertifikat Pemilik; atau</li>
                                        <li>Anda tidak memberikan tanggapan dalam jangka waktu 9 (sembilan) Hari Kalender sejak PSrE TILAKA mengirimkan email terkait penerbitan Sertifikat Pemilik.</li>
                                    </ul>
                                </li>
                                <li>
                                    Dalam hal permohonan penggantian kunci Sertifikat Pemilik, Anda dengan ini mengetahui dan setuju bahwa:
                                    <ul>
                                        <li>Proses penggantian kunci Sertifikat Pemilik mengakibatkan PSrE TILAKA akan melakukan penerbitan Sertifikat Pemilik baru dengan kunci publik, serial number, dan key identifier yang baru, sementara informasi pribadi Pemilik yang tercantum pada Sertifikat Pemilik yang digunakan untuk menandatangani permohonan penggantian Sertifikat Pemilik baru ini akan tetap digunakan pada Sertifikat Pemilik baru yang akan diterbitkan PSrE TILAKA tersebut;</li>
                                        <li>Penggantian kunci Sertifikat Pemilik mengakibatkan PSrE TILAKA akan membangkitkan pasangan kunci baru yang terasosiasi dengan Sertifikat Pemilik yang digunakan untuk menandatangani permohonan penggantian Sertifikat Pemilik baru ini; dan/atau</li>
                                        <li>Masa berlaku Sertifikat Pemilik baru akan berbeda dengan Sertifikat Pemilik yang Anda gunakan untuk menandatangani permohonan penggantian Sertifikat Pemilik ini.</li>
                                    </ul>
                                </li>
                                <li>
                                    Anda setuju untuk tidak menggunakan Layanan TILAKA dengan cara sebagai berikut:
                                    <ul>
                                        <li>Menggunakan Layanan TILAKA untuk tujuan yang melanggar hukum atau ketentuan peraturan perundang-undangan yang berlaku;</li>
                                        <li>Melakukan tindakan yang disebabkan oleh kelalaian atau kesengajaan olehnya, yang pada pokoknya menyebabkan perubahan, penambahan, pengurangan, merusak, menghilangkan, menyembunyikan, membuat tidak dapat digunakannya Layanan TILAKA baik sebagian atau seluruhnya;</li>
                                        <li>Melakukan tindakan yang baik dengan sengaja atau karena kelalaiannya menyebabkan pelanggaran atas hak PSrE TILAKA dalam hal yang termasuk namun tidak terbatas pada pelanggaran privasi, hak cipta, merek, paten, rahasia dagang, atau hak kekayaan intelektual lainnya, hak yang timbul dari hubungan kontraktual antara PSrE TILAKA dengan pihak ketiga lainnya, dan/atau hak lain yang dimiliki PSrE TILAKA baik untuk masa sekarang maupun di kemudian hari yang dilindungi oleh peraturan perundang-undangan yang berlaku; dan</li>
                                        <li>Melakukan tindakan menyalin, memodifikasi, mengadaptasi, menerjemahkan, membuat karya turunan dari, melakukan perekayasaan balik, atau membongkar bagian manapun baik sebagian atau seluruhnya atas Layanan TILAKA.</li>
                                    </ul>
                                </li>
                                <li>Anda setuju bahwa PSrE TILAKA berhak untuk menghentikan sementara atau permanen dengan atau tanpa disertai dengan pencabutan Akun dan/atau Sertifikat Pemilik milik Anda dalam hal terdapat kegiatan untuk meningkatkan pelayanan yang terdapat pada Layanan TILAKA atau pelanggaran dari Anda terhadap ketentuan dari S&K ini.</li>
                                <li>Dalam rangka kegiatan Anda Mengakses Layanan TILAKA, Anda mengetahui dan setuju bahwa  PSrE TILAKA akan akan memberitahukan sebagian atau seluruh informasi yang terdapat dalam Sertifikat Pemilik kepada pihak pengandal dan/atau pihak lainnya, hal mana demikian akan dilakukan oleh PSrE TILAKA dengan tunduk pada ketentuan yang tercantum pada Dokumen Publik sebagaimana disebutkan dalam S&K ini.</li>
                                <li>
                                    Dalam rangka Mengakses Layanan TILAKA, Anda setuju untuk tunduk pada ketentuan yang terdapat pada Dokumen Publik yang terdapat pada Repositori Tilaka serta di tautan yang terdapat pada bagian akhir S&K ini yang terdiri dari:
                                    <ul>
                                        <li><a href="https://repository.tilaka.id/CP_CPS.pdf">Certification Practice Statement (“CPS”);</a></li>
                                        <li><a href="https://repository.tilaka.id/kebijakan-privasi.pdf">Kebijakan Privasi;<a></li>
                                        <li><a href="https://repository.tilaka.id/perjanjian-pemilik-sertifikat.pdf">Perjanjian Pemilik Sertifikat; dan</a></li>
                                        <li><a href="https://repository.tilaka.id/kebijakan-jaminan.pdf">Kebijakan Jaminan</a></li>
                                    </ul>
                                </li>
                                <li>Dalam hal Anda menggunakan Layanan TILAKA melalui aplikasi yang dibuat, dikelola, dikembangkan, atau dimiliki oleh <b><?php echo $_SESSION['hospitalname']?></b> (“aplikasi pihak ketiga”), maka Anda harus mengetahui dan menyetujui bahwa Kami tidak memiliki kendali apapun terhadap konten-konten yang terdapat pada aplikasi tersebut sebelum Anda memilih untuk menggunakan Layanan TILAKA. Akses atau penggunaan Anda terhadap aplikasi <b><?php $_SESSION['hospitalname']?></b> sebelum menggunakan Layanan TILAKA tersebut tunduk pada syarat dan ketentuan serta kebijakan privasi yang ditentukan oleh <b><?php $_SESSION['hospitalname']?></b>.</li>
                                <li>Dalam hal Anda menggunakan Layanan TILAKA melalui aplikasi pihak ketiga, Anda dengan ini mengetahui dan setuju bahwa:
                                    <ul>
                                        <li><b><?php echo $_SESSION['hospitalname']?></b> tidak menyimpan hasil unggahan Dokumen Elektronik berupa Kartu Tanda Penduduk (“KTP”) yang Anda gunakan dalam rangka melakukan Permohonan Penerbitan Sertifikat Pemilik; dan</li>
                                        <li>Untuk kebutuhan pencatatan log internal terhadap Permohonan Penerbitan Sertifikat Pemilik yang Anda lakukan, <b><?php echo $_SESSION['hospitalname']?></b> akan menyimpan informasi nomor induk kependudukan (“NIK”) yang Anda berikan.</li>
                                    </ul>
                                </li>
                                <li>Anda dengan ini melepaskan tanggung jawab Kami terhadap segala tindakan yang dilakukan oleh <b><?php echo $_SESSION['hospitalname']?></b> terhadap isi atau bagian apapun dari aplikasi pihak ketiga tersebut termasuk bagaimana aplikasi pihak ketiga tersebut memperoleh, mengumpulkan, mengolah, menyimpan, menampilkan, mengumumkan, mengirimkan, dan memusnahkan Data Pribadi Anda sebelum, saat, dan setelah Anda menggunakan Layanan TILAKA.</li>
                                <li>Dalam hal karena kelalaian atau kesengajaannya dalam melaksanakan ketentuan dari S&K ini menyebabkan kerugian yang diterima oleh PSrE TILAKA, Anda atau pihak ketiga lainnya. Maka, Anda dengan ini sepakat untuk melepaskan, membebaskan, memberikan ganti rugi, dan membela PSrE TILAKA, termasuk direktur, komisaris, karyawan dan/atau rekanan atas hal-hal yang termasuk namun tidak terbatas pada permintaan, klaim, kerugian, tuntutan, tanggung jawab, kewajiban, kerusakan, ongkos dan biaya yang timbul.</li>
                            </ol>
                            <br>
                            <h5>Kerahasiaan dan Keamanan</h5>
                            <p class="text-xs" style="text-align: justify;">
                                Anda setuju bahwa PSrE TILAKA dapat mengungkapkan atau memberikan akses terhadap informasi, Dokumen Elektronik, Kontrak Elektronik, dan/atau Data Pribadi Anda dalam rangka memenuhi ketentuan hukum, peraturan perundang-undangan dan/atau keputusan pengadilan, hal tersebut dilakukan dalam rangka proses penegakan atau pengambilan tindakan pencegahan lebih lanjut sehubungan dengan kegiatan tidak berwenang, dugaan tindak pidana, pelanggaran hukum dan/atau pelanggaran terhadap peraturan perundang-undangan yang berlaku.
                            </p>
                            <h5>Hak Kekayaan Intelektual</h5>
                            <p class="text-xs" style="text-align: justify;">
                                Nama, kode program, model bisnis, desain, merek dagang, warna, gambar, video, audio, teknologi, dan hal lainnya sehubungan dengan Layanan TILAKA yang belum, dalam proses maupun telah terdaftar atas nama PSrE TILAKA, dilindungi oleh hak kekayaan intelektual termasuk namun tidak terbatas pada hak cipta, merek, paten dan hak kekayaan intelektual yang diatur berdasarkan hukum Negara Republik Indonesia. Tindakan Anda dalam hal mengakses dan menggunakan Layanan TILAKA, tidak mengakibatkan perpindahan baik sebagian atau seluruh Hak Kekayaan Intelektual sehubungan dengan Layanan TILAKA tersebut Anda.
                            </p>
                            <h5>Hubungi TILAKA</h5>
                            <p class="text-xs" style="text-align: justify;">
                                Anda dapat menghubungi PSrE TILAKA melalui surat elektronik (email) ke alamat info@tilaka.id atau dengan mengirimkan dokumen fisik melalui kantor PSrE TILAKA melalui alamat Belleza Shopping Arcade Lantai 3 Unit SA 0380, Jl. Arteri Permata Hijau Nomor 34, RT.004/RW.002, Grogol Utara, Kebayoran Lama, Jakarta Selatan, 12210.
                            </p>
                            <h5>Sengketa</h5>
                            <p class="text-xs" style="text-align: justify;">
                            Segala sengketa terkait dengan penafsiran atau pelaksanaan dari syarat dan ketentuan ini, para pihak sepakat untuk menyelesaikan secara musyawarah untuk mufakat. Apabila penyelesaian secara musyawarah untuk mencapai sepakat tersebut tidak tercapai, maka para pihak sepakat untuk menyelesaikannya melalui Pengadilan Negeri Jakarta Selatan sesuai domisili PSrE TILAKA.
                            </p>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxsyarattilaka"/>
                                <label class="form-check-label" for="flexCheckDefault">
                                Dengan Ini Saya Telah Membaca, Memahaminya dan Menyetujui Syarat dan Kententuan Yang Berlaku
                                </label>
                            </div>
                        </div>                                        
                    </div>
                </div> 
                <div class="modal-footer p-1">	
                    <input class="btn btn-light-primary" id="btnregistrasiusertilaka" type="submit" value="SUBMIT" name="simpan" disabled>			
                </div>  
            </form>  
        </div>
    </div>
</div>