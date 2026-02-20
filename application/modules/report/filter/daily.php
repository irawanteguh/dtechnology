<div class="mb-5">
    <label class="form-label fw-bold">Provider:</label>
    <div>
        <select data-control="select2" data-dropdown-parent="#kt_menu_61484bf6e3ff8" data-placeholder="Please select" class="form-select form-select-solid" data-hide-search="false" data-allow-clear="true" name="toolbar_report_provider" id="toolbar_report_provider">
            <?php echo $provider;?>
        </select>
    </div>
</div>

<div class="mb-5">
    <label class="form-label fw-bold">Periode :</label>
    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
        <input class="form-check-input" type="checkbox" value="Y" name="typeperiode" id="typeperiode" checked="checked" />
        <label class="form-check-label">Today</label>
    </div>
</div>

<div class="mb-5 d-none" id="date-container">
    <label class="form-label fw-bold">Date :</label>
    <input class="form-control form-control-solid flatpickr-input" name="dateperiode" placeholder="Pick a start date" id="dateperiode" type="text">
</div>