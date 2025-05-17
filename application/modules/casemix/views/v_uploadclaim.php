<div class="row gy-5 g-xl-8 mb-xl-8">
<h2>Upload File TXT</h2>

<form id="uploadForm" enctype="multipart/form-data">
    <input type="file" name="txt_file" id="txt_file" accept=".txt" required>
    <button type="submit">Upload</button>
</form>

    <hr>

    <div class="card card card-flush h-100">
        <div class="card-header">
            <div class="card-title d-flex align-items-center">
                <h6 class="fw-bolder m-0 text-gray-800">Preview upload claim</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="col-xl-12">
                <div class="table-responsive" id="preview"></div>
            </div>
        </div>
    </div>
</div>