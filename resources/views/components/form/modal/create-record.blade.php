<div class="modal fade" id="add-transaction-record" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/mn/create/record" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div class="modal-header" style="height: 5rem;">
                    <x-form.dropdown.transaction_type />
                    <div class="position-absolute end-0 me-3">
                        <button type="submit" class="btn"> <img src="/src/img/nav/check.png" alt="Check" height="20"> </button>
                        <button type="button" class="btn" data-bs-dismiss="modal"> <img src="/src/img/nav/cancel.png" alt="Cencel" height="20"></button>
                    </div>
                </div>


                <div class="modal-body" style="">
                    {{-- categoris --}}
                    <div id="select_transaction_categories" class="border-bottom mb-2 pb-2">
                        <div id="expense_categories">
                            <x-form.radio.category :data="$categories['expense']" name="category_id" color="danger" :firstChecked=true />
                        </div>
                        <div id="transfer_categories" class="d-none d-flex justify-content-around">
                            <x-form.dropdown.account :data="$accounts" name="to_account_id" :label=true keterangan="tujuan transfer"/>
                        </div>
                        <div id="income_categories" class="d-none">
                            <x-form.radio.category :data="$categories['income']" name="category_id" color="success" />
                        </div>
                    </div>
                    
                    <div class="container text-center">
                        <div class="row row-cols-4">
                            {{-- subjek --}}
                            <div class="col item-calculator p-1">
                                <x-form.dropdown.party.index :data="$book->parties" name="party_id"/>
                            </div>
                            {{-- nominal --}}
                            <div class="col-9 item-calculator p-1">
                                <div class="position-relative" style="width: 100%; height: 100%;">
                                    <input name="nominal" type="number" 
                                      class="p-0 m-0 position-absolute form-control" style="width: 100%; height: 100%; z-index: 0;" 
                                      oninput="inputNominal(this, '#label-nominal')" min="1" id="transaction_nominal">
                                    <label id="label-nominal" style="width: 100%; height: 100%; z-index: 1;" class="form-control border-primary d-flex align-items-center justify-content-between position-relative" for="transaction_nominal">
                                        <span class="text-body fw-bold d-none mataUang">Rp</span>
                                        <p id="label-nominal" class="nominal text-end mb-0">Nominal</p>
                                    </label>
                                </div>
                            </div>
                            {{-- keterangan --}}
                            <div class="col-12 item-calculator p-1">
                                <input type="text" class="w-100 h-100 form-control rounded-1 border-primary stickScroll" name="description" placeholder="Keterangan" autocomplete>
                            </div>
                            {{-- account --}}
                            <div class="col item-calculator p-1">
                                <x-form.dropdown.account :data="$accounts" name="account_id" keterangan="Sumber dana"/>
                            </div>
                            {{-- tanggal --}}
                            <div class="col item-calculator p-1">
                                <input type="date" name="date" id="transaction_date" value="{{ date("Y-m-d") }}" class="d-none">
                                <label label="date" class="btn btn-primary w-100 h-100 align-content-center" for="transaction_date">Today</label>
                            </div>
                            {{-- ajax --}}
                            <div class="col item-calculator p-1">
                                <button type="button" class="btn btn-primary w-100 h-100 disabled">Ajax</button>
                            </div>
                            {{-- clear --}}
                            <div class="col item-calculator p-1">
                                <button type="button" class="btn btn-primary w-100 h-100 disabled" onclick="modalClear('#select_transaction_categories')">Clear</button>
                            </div>
                            
                        </div>
                        
                        


                        {{-- <div class="row m-0">
                            <div class="row w-100 p-0" style="height: 3.5rem;">
                                account
                                <div class="col-3 p-1">
                                </div>
                                <div class="col-3 p-1">
                                </div>
                                tombol ajax
                                <div class="col-3 p-1">
                                </div>
                                tombol clear
                                <div class="col p-1">
                                </div>
                            </div>
                            keterangan
                            <div class="row w-100 p-0" style="height: 3.5rem;">
                                <div class="col-12 p-0">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer" style="">
                    <button type="submit" class="btn btn-success px-4 py-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>