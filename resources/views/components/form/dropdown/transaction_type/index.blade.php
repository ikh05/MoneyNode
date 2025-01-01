<div class="btn-group">
    <input type="hidden" name="type" value='expense'>
    <button class="btn dropdown-toggle fs-4 border-bottom rounded-bottom-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="/src/img/nav/pengeluaran.png" alt="Pengeluaran" height="20"> Pengeluaran
    </button>
    <ul class="dropdown-menu">
        <li value="expense" class="dropdown-item active" onclick="selectTransactionType('expense')"> <img src="/src/img/nav/pengeluaran.png" alt="Pengeluaran" height="20"> Pengeluaran</li>
        <li value="transfer" class="dropdown-item" onclick="selectTransactionType('transfer')"> <img src="/src/img/nav/transfer.png" alt="Pengeluaran" height="20"> Transfer</li>
        <li value="income" class="dropdown-item" onclick="selectTransactionType('income')"> <img src="/src/img/nav/pemasukkan.png" alt="Pengeluaran" height="20"> Pemasukkan</li>
    </ul>
</div>