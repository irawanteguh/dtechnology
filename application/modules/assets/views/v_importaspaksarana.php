
<div class="row gy-5 g-xl-8 mb-xl-8">
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="txt_file" class="form-label fw-bold">Upload File Aspak Sarana</label>
            <div class="input-group">
                <input type="file" class="form-control" name="txt_file" id="txt_file" accept=".txt" required>
                <button class="btn btn-primary btn-sm" type="submit" id="actionBtn">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </div>
        </div>
    </form>

    <div class="border-dashed border-3 border-primary"></div>

    <div class="card card card-flush h-100">
        <div class="card-header">
            <div class="card-title d-flex align-items-center">
                <h6 class="fw-bolder m-0 text-gray-800">Preview upload Aspak Sarana</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="col-xl-12">
                <div class="table-responsive" id="preview"></div>
            </div>
        </div>
    </div>
</div>