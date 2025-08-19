<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0 pt-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1"><?php echo $judulelement;?></span>
					<span class="text-muted mt-1 fw-bold fs-7"></span>
				</h3>
			</div>
			<div class="card-body">
                <table class="table align-middle table-row-dashed fs-8 gy-2">
                    <thead>
                        <tr class="fw-bolder text-muted bg-light align-middle">
                            <th class="ps-4 rounded-start">#</th>
                            <th>Judul Dokumen</th>
                            <th>Catatan</th>
                            <th class="text-end">Created By</th>
                            <th class="pe-4 text-end rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold"><?php echo $listdokument;?></tbody>
                </table>
			</div>
		</div>
	</div>
</div>