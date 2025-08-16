<?php 
    $xids = $this->input->get('xids'); 
    $xide = $this->input->get('xide'); 
?>

<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Standart Akreditasi</h1>
<span class="h-20px border-gray-200 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!-- Level BAB -->
    <li class="breadcrumb-item text-muted">
        <a href="../../index.php/akreditasi/selfassessment" 
           class="<?php echo $xids ? 'text-muted text-hover-primary' : 'breadcrumb-item text-dark'; ?>">
           BAB
        </a>
    </li>

    <?php if($xids): ?>
        <!-- Separator -->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!-- Level Standart -->
        <li class="breadcrumb-item text-muted">
            <a href="../../index.php/akreditasi/selfassessment?xids=<?php echo $xids; ?>" 
               class="<?php echo $xide ? 'text-muted text-hover-primary' : 'breadcrumb-item text-dark'; ?>">
               Standart Penilaian <?php echo $judulbab;?>
            </a>
        </li>
    <?php endif; ?>

    <?php if($xids && $xide): ?>
        <!-- Separator -->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <!-- Level Element -->
        <li class="breadcrumb-item text-dark">
            Element Penilaian <?php echo $judulstandart;?>
        </li>
    <?php endif; ?>
</ul>
