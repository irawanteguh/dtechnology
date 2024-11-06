
<div class="row gy-5 g-xl-8 mb-xl-8">
    <div class="col-xl-4">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Summary of activity input</h3>
                    <div class="fs-6 fw-bold text-gray-400" id="countoverduelabel"></div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div id="kepatuhaninput" style="width: 100%; max-height: 200px; height: 100vh;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-flush h-100">
            <div class="card-header pt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">Summary validation</h3>
                    <div class="fs-6 fw-bold text-gray-400" id="countoverduelabel"></div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div id="kepatuhanvalidasi" style="width: 100%; max-height: 200px; height: 100vh;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gy-5 g-xl-8 mb-xl-8">
	<div class="col-xl-12">
		<div class="card card-flush">
			<div class="card-header pt-5" id="">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label fw-bolder fs-3 mb-1">Report key performance index</span>
					<span class="text-muted mt-1 fw-bold fs-7">-</span>
				</h3>
			</div>
			<div class="card-body py-3">
				<div class="table-responsive mh-600px scroll-y me-n5 pe-5">
					<table class="table align-middle table-row-dashed fs-6 gy-2" id="tablemasterkaryawan">
						<thead>
							<tr class="fw-bolder text-muted bg-light">
								<th class="ps-4 rounded-start">Identity</th>
                                <th>Name</th>
                                <th>Position</th>
								<th class="text-center">% Activities</th>
                                <th class="text-center">% Behavior</th>
                                <th class="text-center">% Result</th>
								<th class="pe-4 text-end rounded-end">Actions</th>
							</tr>
						</thead>
						<tbody class="text-gray-600 fw-bold" id="resultkpi"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>