<div class="modal fade" id="modal_assets_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/assets/listassets/insertassets" id="forminsertassets">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Add Assets</h1>
                        <div class="text-muted fw-bold fs-5">Please Add Assets</div>
                    </div>
                    <div class="row">
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper" data-kt-stepper="true">
							<div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
								<div class="stepper-nav ps-lg-10">

									<div class="stepper-item current" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">1</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Informasi Asset</h3>
											<div class="stepper-desc">Lengkapi informasi aset</div>
										</div>
									</div>

									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">2</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Spesifikasi Asset</h3>
											<div class="stepper-desc">Masukkan spesifikasi asset</div>
										</div>
									</div>

									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">3</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Nilai Asset</h3>
											<div class="stepper-desc">Masukkan nilai asset</div>
										</div>
									</div>

									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">4</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Dokumen Aset</h3>
											<div class="stepper-desc">Unggah dokumen pendukung</div>
										</div>
									</div>

								</div>
							</div>
							<div class="flex-row-fluid py-lg-5 px-lg-15">
								<form class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_modal_create_app_form">
	
									<div class="current" data-kt-stepper-element="content">
										<div class="w-100">
											<div class="fv-row mb-10 fv-plugins-icon-container">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Nama Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Specify your unique app name" aria-label="Specify your unique app name"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder="" value="">
											</div>

											<div class="fv-row">
												<label class="d-flex align-items-center fs-5 fw-bold mb-4">
													<span class="required">Kategori Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Select your app category" aria-label="Select your app category"></i>
												</label>
												<div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
													<?php echo $kategoriassets;?>
                                                </div>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Tahun Dibangun</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tahun bangunan mulai dibangun"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="tahun_dibangun" placeholder="Contoh: ± 2013">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Jumlah Lantai</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jumlah total lantai bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="jumlah_lantai" placeholder="Contoh: 6 (enam) lantai">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Pondasi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis pondasi bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="pondasi" placeholder="Contoh: Tiang pancang / Bor pile">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Struktur</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Struktur utama bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="struktur" placeholder="Contoh: Beton bertulang">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Rangka Atap</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis rangka atap"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="rangka_atap" placeholder="Contoh: Dak beton">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Penutup Atap</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Bahan penutup atap"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="penutup_atap" placeholder="Contoh: Dak beton">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Plafon</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis plafon yang digunakan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="plafon" placeholder="Contoh: Gypsum">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Dinding & Pelapis</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis material dan pelapis dinding"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="dinding_pelapis" placeholder="Contoh: Bata ringan dilapis cat">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Pintu</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis bahan dan rangka pintu"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="pintu" placeholder="Contoh: Kaca rangka aluminium">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Jendela</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis bahan dan rangka jendela"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="jendela" placeholder="Contoh: Kaca rangka aluminium">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Lantai</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Material lantai utama"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="lantai" placeholder="Contoh: Keramik">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Luas (m²)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Total luas bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="luas" placeholder="Contoh: ± 3.241,00 m²">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Kualitas Bangunan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Kualitas konstruksi secara umum"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="kualitas_bangunan" placeholder="Contoh: Baik">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Kondisi Bangunan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Kondisi terkini bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="kondisi_bangunan" placeholder="Contoh: Terawat">
											</div>

										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Nilai Perolehan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Harga awal perolehan aset/bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="nilai_perolehan" placeholder="Contoh: 12.500.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Biaya Perijinan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="IMB, SLF, PBG, amdal, dll."></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="biaya_perijinan" placeholder="Contoh: 150.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Biaya Konsultan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya arsitek, struktur, MEP, manajemen proyek"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="biaya_konsultan" placeholder="Contoh: 250.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Biaya Konstruksi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nilai pekerjaan fisik bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="biaya_konstruksi" placeholder="Contoh: 10.000.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Biaya Pengawasan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Pengawasan pekerjaan, audit teknis, supervisi"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="biaya_pengawasan" placeholder="Contoh: 200.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Bunga Pinjaman</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jika pembangunan dibiayai kredit/pinjaman"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="bunga_pinjaman" placeholder="Contoh: 100.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Biaya Pemeliharaan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Perawatan awal setelah serah terima konstruksi"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="biaya_pemeliharaan_awal" placeholder="Contoh: 50.000.000">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Depresiasi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Waktu penyusutan aset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="depresiasi" placeholder="Contoh: 20 Tahun">
											</div>


										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Sertifikat Kepemilikan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jenis sertifikat seperti SHM, HGB, dsb."></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="sertifikat_kepemilikan" placeholder="Contoh: SHM No. 12345/2020">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Izin Mendirikan Bangunan (IMB)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor dan tanggal IMB atau PBG"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="imb" placeholder="Contoh: IMB No. 123/IMB/2020">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Gambar / Blueprint</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama file atau link ke dokumen gambar bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="blueprint" placeholder="Contoh: blueprint_rsu_2020.pdf">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Laporan Penilaian Aset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi appraisal / penilaian aset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="laporan_penilaian" placeholder="Contoh: LAP/Penilaian/2023/001">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Status Hukum</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Milik sendiri / sewa / pinjam pakai, dll."></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="status_hukum" placeholder="Contoh: Milik sendiri">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Nama Pemilik / Instansi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nama pemilik bangunan atau lembaga terkait"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="nama_pemilik" placeholder="Contoh: PT Rumah Sehat Indonesia">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Nomor Dokumen Legal</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor dokumen hukum terkait kepemilikan / hak guna"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="nomor_dokumen" placeholder="Contoh: 0123/SHM/2022">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Alamat Lengkap</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Alamat lokasi bangunan secara lengkap"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="alamat_lengkap" placeholder="Contoh: Jl. Kesehatan No.12, Jakarta Selatan, DKI Jakarta">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-3">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Latitude</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Koordinat latitude lokasi bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="latitude" placeholder="Contoh: -6.231234">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-3">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Longitude</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Koordinat longitude lokasi bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="longitude" placeholder="Contoh: 106.812345">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Link Google Maps (opsional)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Link lokasi di Google Maps (bila tersedia)"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" name="link_maps" placeholder="Contoh: https://maps.google.com/?q=-6.23,106.81">
											</div>



										</div>
									</div>
									
									<div class="d-flex flex-stack pt-10">
										<div class="me-2">
											<button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
												<span class="svg-icon svg-icon-3 me-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black"></rect>
														<path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black"></path>
													</svg>
												</span>
												Back
											</button>
										</div>
										<div>
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
												<span class="indicator-label">Submit
													<span class="svg-icon svg-icon-3 ms-2 me-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
														</svg>
													</span>
												</span>
												<span class="indicator-progress">Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											</button>
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
												Continue
												<span class="svg-icon svg-icon-3 ms-1 me-0">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
														<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
													</svg>
												</span>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>