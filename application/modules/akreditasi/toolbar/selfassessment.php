<?php 
    $xidb      = $this->input->get('xidb');
    $xids      = $this->input->get('xids');
    $xide      = $this->input->get('xide');
    $leveluser = $_SESSION['leveluser'] ?? null;
?>

<?php if ($leveluser === "83e9982c-814a-4349-89fb-cbee6f34e340"): ?>

    <?php if ($xidb && $xids && $xide): ?>
        <a class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modal_upload_document"><i class="bi bi-cloud-arrow-up me-4"></i>Upload Dokumen</a>
        <a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal_penilaian"><i class="bi bi-pencil-square me-4"></i>Penilaian Dokumen</a>
    <?php elseif ($xidb && $xids): ?>
        <!-- Kondisi 3: Tambah Elemen -->
        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_element_add">
            <i class="bi bi-database-fill-add me-4"></i>Tambah Elemen Penilaian
        </a>

    <?php elseif ($xidb): ?>
        <!-- Kondisi 2: Tambah Standar -->
        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_standart_add">
            <i class="bi bi-database-fill-add me-4"></i>Tambah Standar Penilaian
        </a>
    <?php endif; ?>

<?php endif; ?>
