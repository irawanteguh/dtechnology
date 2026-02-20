<?php 
    $xidb = $this->input->get('xidb'); 
    $xids = $this->input->get('xids'); 
    $xide = $this->input->get('xide'); 
?>

<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Standart Akreditasi</h1>
<span class="h-20px border-gray-200 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!-- Level 1 : BAB -->
    <li class="breadcrumb-item text-muted">
        <a href="../../index.php/akreditasi/selfassessment" 
           class="<?php echo $xidb ? 'text-muted text-hover-primary' : 'breadcrumb-item text-dark'; ?>">
           BAB
        </a>
    </li>

    <!-- Level 2 : Standar Penilaian -->
    <?php if($xidb): ?>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="../../index.php/akreditasi/selfassessment?xidb=<?php echo $xidb; ?>" 
               class="<?php echo $xids ? 'text-muted text-hover-primary' : 'breadcrumb-item text-dark'; ?>">
               Standart Penilaian <?php echo $judulbab;?>
            </a>
        </li>
    <?php endif; ?>

    <!-- Level 3 : Elemen Penilaian -->
    <?php if($xidb && $xids): ?>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item <?php echo $xide ? 'text-muted' : 'text-dark'; ?>">
            <a href="../../index.php/akreditasi/selfassessment?xidb=<?php echo $xidb; ?>&xids=<?php echo $xids; ?>"
               class="<?php echo $xide ? 'text-muted text-hover-primary' : 'breadcrumb-item text-dark'; ?>">
               Element Penilaian <?php echo $judulstandart;?>
            </a>
        </li>
    <?php endif; ?>

    <!-- Level 4 : Upload Document -->
    <?php if($xidb && $xids && $xide): ?>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">
            Upload Document
        </li>
    <?php endif; ?>
</ul>
