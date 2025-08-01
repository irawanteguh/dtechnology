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
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="modal_assets_add_stepper" data-kt-stepper="true">
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
											<h3 class="stepper-title">Utilisasi</h3>
											<div class="stepper-desc">Masukkan utilisasi</div>
										</div>
									</div>
									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">4</span>
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
											<span class="stepper-number">5</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Dokumen Aset</h3>
											<div class="stepper-desc">Unggah dokumen pendukung</div>
										</div>
									</div>
									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">6</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Lokasi</h3>
											<div class="stepper-desc">Lokasi / penempatan asset</div>
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
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Silakan masukan nama asset" aria-label="Silakan masukan nama asset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_name" name="modal_assets_add_name" placeholder="Silakan masukan nama asset">
											</div>
											<div class="fv-row">
												<label class="d-flex align-items-center fs-5 fw-bold mb-4">
													<span class="required">Kategori Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Silakan masukan kategori asset" aria-label="Silakan masukan kategori asset"></i>
												</label>
												<div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
													<?php echo $kategoriassetsadd;?>
                                                </div>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Spesifikasi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Silakan masukan spesifikasi asset" aria-label="Silakan masukan spesifikasi asset"></i>
												</label>
												<textarea class="form-control form-control-lg form-control-solid" name="modal_assets_add_spesifikasi" id="modal_assets_add_spesifikasi"></textarea>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Tahun Perolehan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tahun Perolehan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_tahun" name="modal_assets_add_tahun" placeholder="Contoh: ± 2013">
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Tanggal Pembelian</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tanggal Pembelian"></i>
												</label>
												<input class="form-control form-control-solid flatpickr-input" name="modal_assets_add_tanggal" placeholder="Pilih Tanggal Pembelian" id="modal_assets_add_tanggal" type="text">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Qty / Luas (m²)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Total QTY / luas bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_volume" name="modal_assets_add_volume" placeholder="Contoh: ± 3.241,00 m² / 1 Unit">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Estimasi Penggunaan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_penggunaan" name="modal_assets_add_penggunaan" placeholder="Contoh: 5 Tindakan / Hari" required>
											</div>						
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Operasional 24 Jam</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Apakah Assets Beroperasional 24 Jam"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Operasional 24 Jam</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" id="modal_assets_add_operasional" name="modal_assets_add_operasional">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Menggunakan Air</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Menggunakan Air</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" id="modal_assets_add_air" name="modal_assets_add_air">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Menggunakan Internet</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Menggunakan Internet</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" ID="modal_assets_add_internet" name="modal_assets_add_internet">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Menggunakan listrik</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Menggunakan Listrik</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" id="modal_assets_add_listrik" name="modal_assets_add_listrik">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Beban Listrik (kW)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Masukkan estimasi beban listrik per hari dalam satuan kilowatt (kW)."></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_vollistrik" name="modal_assets_add_vollistrik" placeholder="Contoh: 5 kW" required>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Nilai Perolehan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Harga awal perolehan aset/bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid currency-rp" id="modal_assets_add_nilaiasset" name="modal_assets_add_nilaiasset" placeholder="Contoh: 12.500.000.000" required>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Sumber Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Lokasi Penempatan Barang"></i>
												</label>
												<select data-control="select2" data-dropdown-parent="#modal_assets_add" data-placeholder="Please Select Location" class="form-select form-select-solid" id="modal_assets_add_sumber" name="modal_assets_add_sumber" required>
													<?php echo $sumberassetadd;?>
												</select>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Depresiasi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Waktu penyusutan aset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_depresiasi" name="modal_assets_add_depresiasi" placeholder="Contoh: 20 Tahun" required>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Biaya Pemeliharaan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya pemeliharaan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid currency-rp" id="modal_assets_add_nilaipemeliharaan" name="modal_assets_add_nilaipemeliharaan" placeholder="Contoh: 50.000.000 / Bulan">
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Jangka Waktu Pinjaman</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jangka Waktu Pinjaman Jika pembangunan dibiayai kredit/pinjaman"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_waktubunga" name="modal_assets_add_waktubunga" placeholder="Contoh: 20 Tahun" required>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Bunga Pinjaman</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jika pembangunan dibiayai kredit/pinjaman"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid currency-rp" id="modal_assets_add_nilaibunga" name="modal_assets_add_nilaibunga" placeholder="Contoh: 100.000.000" required>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Serial Number</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi serial number"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_sn" name="modal_assets_add_sn" placeholder="Contoh: XXXXXX">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>No Inventaris</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi no iventaris"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_noinventaris" name="modal_assets_add_noinventaris" placeholder="Contoh: 0001/JANGMED/2025">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Laporan Penilaian Aset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi appraisal / penilaian aset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_add_laporanasset" name="modal_assets_add_laporanasset" placeholder="Contoh: LAP/Penilaian/2023/001">
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Lokasi Penempatan Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Lokasi Penempatan Barang"></i>
												</label>
												<select data-control="select2" data-dropdown-parent="#modal_assets_add" data-placeholder="Please Select Location" class="form-select form-select-solid" id="modal_assets_add_location" name="modal_assets_add_location" required>
													<?php echo $locationadd;?>
												</select>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Status Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Status Asset"></i>
												</label>
												<select data-control="select2" data-dropdown-parent="#modal_assets_add" data-placeholder="Please Select Location" class="form-select form-select-solid" id="modal_assets_add_status" name="modal_assets_add_status" required>
													<?php echo $statusassetadd;?>
												</select>
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
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit" id="btn_submit_assets">
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

<div class="modal fade" id="modal_assets_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <form action="<?php echo base_url();?>index.php/assets/listassets/editassets" id="formeditassets">
				<input type="hidden" id="modal_assets_edit_transid" name="modal_assets_edit_transid">
                <div class="modal-body">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Edit Assets</h1>
                        <div class="text-muted fw-bold fs-5">Please Edit Assets</div>
                    </div>
                    <div class="row">
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="modal_assets_edit_stepper" data-kt-stepper="true">
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
											<h3 class="stepper-title">Utilisasi</h3>
											<div class="stepper-desc">Masukkan utilisasi</div>
										</div>
									</div>
									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">4</span>
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
											<span class="stepper-number">5</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Dokumen Aset</h3>
											<div class="stepper-desc">Unggah dokumen pendukung</div>
										</div>
									</div>
									<div class="stepper-item" data-kt-stepper-element="nav">
										<div class="stepper-line w-40px"></div>
										<div class="stepper-icon w-40px h-40px">
											<i class="stepper-check fas fa-check"></i>
											<span class="stepper-number">6</span>
										</div>
										<div class="stepper-label">
											<h3 class="stepper-title">Lokasi</h3>
											<div class="stepper-desc">Lokasi / penempatan asset</div>
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
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Silakan masukan nama asset" aria-label="Silakan masukan nama asset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_name" name="modal_assets_edit_name" placeholder="Silakan masukan nama asset">
											</div>
											<div class="fv-row">
												<label class="d-flex align-items-center fs-5 fw-bold mb-4">
													<span class="required">Kategori Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Silakan masukan kategori asset" aria-label="Silakan masukan kategori asset"></i>
												</label>
												<div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
													<?php echo $kategoriassetsedit;?>
                                                </div>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Spesifikasi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Silakan masukan spesifikasi asset" aria-label="Silakan masukan spesifikasi asset"></i>
												</label>
												<textarea class="form-control form-control-lg form-control-solid" name="modal_assets_edit_spesifikasi" id="modal_assets_edit_spesifikasi"></textarea>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Tahun Perolehan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tahun Perolehan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_tahun" name="modal_assets_edit_tahun" placeholder="Contoh: ± 2013">
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Tanggal Pembelian</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tanggal Pembelian"></i>
												</label>
												<input class="form-control form-control-solid flatpickr-input" name="modal_assets_edit_tanggal" placeholder="Pilih Tanggal Pembelian" id="modal_assets_edit_tanggal" type="text">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Qty / Luas (m²)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Total QTY / luas bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_volume" name="modal_assets_edit_volume" placeholder="Contoh: ± 3.241,00 m² / 1 Unit">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span class="required">Estimasi Penggunaan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_penggunaan" name="modal_assets_edit_penggunaan" placeholder="Contoh: 5 Tindakan / Hari" required>
											</div>						
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Operasional 24 Jam</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Apakah Assets Beroperasional 24 Jam"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Operasional 24 Jam</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" id="modal_assets_edit_operasional" name="modal_assets_edit_operasional">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Menggunakan Air</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Menggunakan Air</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" id="modal_assets_edit_air" name="modal_assets_edit_air">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Menggunakan Internet</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Menggunakan Internet</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" ID="modal_assets_edit_internet" name="modal_assets_edit_internet">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<div class="d-flex flex-stack">
													<div class="me-5">
														<label class="d-flex align-items-center fs-5 fw-bold mb-2">
															<span>Menggunakan listrik</span>
															<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Estimasi Penggunaan Dalam Sehari"></i>
														</label>
														<div class="fs-7 fw-bold text-muted">Assets Menggunakan Listrik</div>
													</div>
													<div class="d-flex">
														<label class="form-check form-check-custom form-check-solid">
															<input class="form-check-input h-20px w-20px" type="checkbox" id="modal_assets_edit_listrik" name="modal_assets_edit_listrik">
															<span class="form-check-label fw-bold">Klik Jika Iya</span>
														</label>
													</div>
												</div>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Beban Listrik (kW)</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Masukkan estimasi beban listrik per hari dalam satuan kilowatt (kW)."></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_vollistrik" name="modal_assets_edit_vollistrik" placeholder="Contoh: 5 kW" required>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Nilai Perolehan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Harga awal perolehan aset/bangunan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid currency-rp" id="modal_assets_edit_nilaiasset" name="modal_assets_edit_nilaiasset" placeholder="Contoh: 12.500.000.000" required>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Sumber Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Lokasi Penempatan Barang"></i>
												</label>
												<select data-control="select2" data-dropdown-parent="#modal_assets_edit" data-placeholder="Please Select Location" class="form-select form-select-solid" id="modal_assets_edit_sumber" name="modal_assets_edit_sumber" required>
													<?php echo $sumberassetedit;?>
												</select>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Depresiasi</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Waktu penyusutan aset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_depresiasi" name="modal_assets_edit_depresiasi" placeholder="Contoh: 20 Tahun" required>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Biaya Pemeliharaan</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Biaya pemeliharaan"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid currency-rp" id="modal_assets_edit_nilaipemeliharaan" name="modal_assets_edit_nilaipemeliharaan" placeholder="Contoh: 50.000.000 / Bulan">
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Jangka Waktu Pinjaman</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jangka Waktu Pinjaman Jika pembangunan dibiayai kredit/pinjaman"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_waktubunga" name="modal_assets_edit_waktubunga" placeholder="Contoh: 20 Tahun" required>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Bunga Pinjaman</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Jika pembangunan dibiayai kredit/pinjaman"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid currency-rp" id="modal_assets_edit_nilaibunga" name="modal_assets_edit_nilaibunga" placeholder="Contoh: 100.000.000" required>
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Serial Number</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi serial number"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_sn" name="modal_assets_edit_sn" placeholder="Contoh: XXXXXX">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>No Inventaris</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi no iventaris"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_noinventaris" name="modal_assets_edit_noinventaris" placeholder="Contoh: 0001/JANGMED/2025">
											</div>

											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-6">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Laporan Penilaian Aset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Nomor atau referensi appraisal / penilaian aset"></i>
												</label>
												<input type="text" class="form-control form-control-lg form-control-solid" id="modal_assets_edit_laporanasset" name="modal_assets_edit_laporanasset" placeholder="Contoh: LAP/Penilaian/2023/001">
											</div>
										</div>
									</div>

									<div data-kt-stepper-element="content">
										<div class="w-100 row">
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Lokasi Penempatan Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Lokasi Penempatan Barang"></i>
												</label>
												<select data-control="select2" data-dropdown-parent="#modal_assets_edit" data-placeholder="Please Select Location" class="form-select form-select-solid" id="modal_assets_edit_location" name="modal_assets_edit_location" required>
													<?php echo $locationedit;?>
												</select>
											</div>
											<div class="fv-row mb-10 fv-plugins-icon-container col-xl-12">
												<label class="d-flex align-items-center fs-5 fw-bold mb-2">
													<span>Status Asset</span>
													<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Status Asset"></i>
												</label>
												<select data-control="select2" data-dropdown-parent="#modal_assets_edit" data-placeholder="Please Select Location" class="form-select form-select-solid" id="modal_assets_edit_status" name="modal_assets_edit_status" required>
													<?php echo $statusassetedit;?>
												</select>
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
											<button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit" id="btn_edit_assets">
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