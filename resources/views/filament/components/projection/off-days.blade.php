<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="off_working_days">
    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
        Select Off days
    </span>
</label>
<input type="text" wire:model="data.off_working_days" id="off_working_days" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Initialize Flatpickr
    flatpickr("#off_working_days", {
        // Options
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        mode: "multiple",
        enableTime: false,
    });
</script>
