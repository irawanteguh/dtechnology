
<style>
/* ==== METRO TILE STYLE (Bootstrap-based) ==== */
.metro-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 20px;
    padding: 30px;
}

.metro-tile {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff !important;
    text-decoration: none;
    height: 140px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.25s ease-in-out;
    cursor: pointer;
    transform-origin: center;
}

.metro-tile i {
    font-size: 40px;
    margin-bottom: 10px;
    color: #fff !important;
}

.metro-tile span {
    font-weight: 600;
    font-size: 16px;
    text-align: center;
    color: #fff !important;
}

/* Efek visual tambahan saat hover */
.metro-tile:hover {
    transform: scale(1.08);
    filter: brightness(1.1);
    box-shadow: 0 10px 18px rgba(0,0,0,0.25);
}
</style>

<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-size: auto 100%; background-image: url('<?php echo base_url();?>assets/images/svg/misc/taieri.svg')">

    <div class="metro-container" id="listmenus"></div>
</div>
