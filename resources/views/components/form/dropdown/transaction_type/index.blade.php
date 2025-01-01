<div class="btn-group">
    <input type="hidden" name="type" value='expense'>
    <button class="btn dropdown-toggle fs-4 border-bottom rounded-bottom-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <x-image.nav class="ms-2" file_name="pengeluaran" height="20"/> Pengeluaran
    </button>
    <ul class="dropdown-menu">
        <li value="expense" class="dropdown-item active" onclick="selectTransactionType('expense')"> <x-image.nav class="ms-2" file_name="pengeluaran" height="20" /> Pengeluaran</li>
        <li value="transfer" class="dropdown-item" onclick="selectTransactionType('transfer')"> <x-image.nav class="ms-2" file_name="transfer" height="20" /> Transfer</li>
        <li value="income" class="dropdown-item" onclick="selectTransactionType('income')"> <x-image.nav class="ms-2" file_name="pemasukkan" height="20" /> Pemasukkan</li>
    </ul>
</div>