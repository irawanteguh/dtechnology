<?php 
    $xids      = $this->input->get('xids');
    $xide      = $this->input->get('xide');
    $leveluser = $_SESSION['leveluser'] ?? null;
?>

<?php if ($xids && $leveluser === "83e9982c-814a-4349-89fb-cbee6f34e340"): ?>
    <?php if ($xide): ?>
        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_element_add">
            <i class="bi bi-database-fill-add me-4"></i>Tambah Elemen Penilaian
        </a>
    <?php else: ?>
        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_standart_add">
            <i class="bi bi-database-fill-add me-4"></i>Tambah Standar Penilaian
        </a>
    <?php endif; ?>
<?php endif; ?>
