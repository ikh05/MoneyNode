console.log('file function.js sudah load 1.7.8');


function toggleClass(element, nameClass){
    stringToDOM(element).classList.toggle(nameClass);
}
function singleActiveClass(excludeElement, className, elements, invers = false) {
    Array.from(elements).map(e => (invers ? (e === excludeElement) : !(e === excludeElement)) ? e.classList.remove(className) : e.classList.add(className) )
}

function intFormatID(value, noValid = '') {
    if (value <= 0) return noValid;
    return parseInt(value, 10).toLocaleString('id-ID');
}

function togglePassword(button, element){
    element = stringToDOM(element);
    [...button.children].map(c => toggleClass(c, 'd-none'));
    if(element.getAttribute('type') === 'password'){
        element.setAttribute('type', 'text');
    }else{
        element.setAttribute('type', 'password');
    }
}

function changeAttribute(nameAttribute, valueAttribute, target){
    stringToDOM(target).setAttribute(nameAttribute, valueAttribute);
}

function stringToDOM(element){
    return typeof element === 'string' ? document.querySelector(element) : element;
}

























let ret = '';
// Fungsi yang dijalankan setelah change
document.addEventListener('change', function(e){
    
});

// Fungsi yang dijalankan setelah resize
window.addEventListener('resize', function(){
    // cut Width
    cutWidth();
});
// Fungsi yang dijalankan setelah di LOAD
document.addEventListener('DOMContentLoaded', function(e){
    // 
    const deleteButtons = document.querySelectorAll('.form-delete .btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.form-delete');
                if (confirm(button.getAttribute('teks-confirm'))) {
                    form.submit();
                }
            });
        });


    // ajax
    const ajaxElements = Array.from(document.querySelectorAll('.ajax'));
    ajaxElements.forEach(ajax => {
        let event =  ajax.getAttribute('triger-ajax') || 'click';
        console.log(event);
        ajax.addEventListener(event, async function(e){
            let attributes = Array.from(this.attributes)
                .filter(attr => attr.name.startsWith('ajax-'))
                .reduce((obj, attr) => {
                    obj[attr.name.replace('ajax-', '')] = attr.value;
                    return obj;
                }, {});
            if(ajax.hasAttribute('name')){
                attributes[ajax.getAttribute('name')] = ajax.value;
            }
            console.log({ tasks: [attributes] });
            
            try {
                // Kirim permintaan AJAX dengan Fetch API
                const response = await fetch(this.getAttribute('url'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('[name=_token]').value,
                    },
                    body: JSON.stringify({ tasks: [attributes] }) // Kirim sebagai array
                });
                const data = await response.json();
                alert('Status tugas berhasil di perbarui');
                document.getElementById('status-ajax').innerHTML = 'Status tugas berhasil di perbarui';
            }catch (error) {
                alert('Proses gagal');
                document.getElementById('status-ajax').innerHTML = 'Proses Gagal';
            }
        })
    })

    // filter
    // Tambahkan event listener ke semua elemen dengan atribut `filtertarget`
    const filterElements = document.querySelectorAll('[target-filter]');
    filterElements.forEach(filterElement => {
        const inputs = filterElement.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            // Trigger filter saat ada perubahan input
            input.addEventListener('input', () => {
                applyFilter(filterElement); 
                cutWidth();
            });
            input.addEventListener('change', () => {
                applyFilter(filterElement); 
                cutWidth();
            });
        });
    });
    
    // popover
    // Inisialisasi popover untuk setiap elemen dengan data-bs-toggle="popover"
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [];

    popoverTriggerList.forEach(popoverTriggerEl => {
        // Ambil elemen konten dari atribut 'content-popover'
        const contentElement = document.querySelector(popoverTriggerEl.getAttribute('content-popover'));
        const popoverInstance = contentElement === null
            ? new bootstrap.Popover(popoverTriggerEl)    
            : new bootstrap.Popover(popoverTriggerEl, {
                // customClass: 'popover-user',
                customClass: popoverTriggerEl.getAttribute('popover-class') || 'popover-user',
                content: contentElement, // Set konten dari elemen yang ditargetkan
                html: true, // Aktifkan mode HTML
                sanitize: true // Nonaktifkan sanitasi jika menggunakan konten HTML
            });

        // Simpan instance popover untuk digunakan kemudian
        popoverList.push(popoverInstance);
    });

    // Fungsi yang dijalankan jika ada klik
    document.addEventListener('click', function (e) {
        if (!e.target.closest('[data-bs-toggle="popover"]')) {
            // Tutup semua popover yang sedang terbuka
            popoverList.forEach(popoverInstance => {
                popoverInstance.hide(); // Menutup popover menggunakan instance
            });
        }
    });
    
    // cut Width
    cutWidth();
    
    // date,  cukup tambahkan attribut label="date"
    const date = document.querySelectorAll('[label=date]');
    [...date].forEach(date => {
        const input = document.getElementById(date.getAttribute('for'))
        const value = input.value;
        date.addEventListener('click', function(){
            input.showPicker()
        })
        input.addEventListener('change', function(){
            if(input.value === value) date.innerHTML = "Today";
            else {
                date.innerHTML = input.value.split('-').reverse().map(e => e > 99 ? e%100 : e).join('/');
            }
        })
    })
    // date tetapi tidak mengubah label, cukup tambahkan attribut label="date-none"
    const date_none = document.querySelectorAll('[label=date-none]');
    [...date_none].forEach(date => {
        const input = document.getElementById(date.getAttribute('for'))
        date.addEventListener('click', function(){
            input.showPicker()
        })
    })


    // dropdown
    const dropdown = document.querySelectorAll('.dropdown-item');
    [...dropdown].forEach(dropdown => {
        if(dropdown.classList.change('dropdown-normal')) return;
        dropdown.addEventListener('click', function(d){
            // d pasti dropdown-item
            d = d.target
            while (!d.classList.contains('dropdown-item') && d != document.querySelector('body')) {
                d = d.parentElement
            }
            const parent = d.parentElement.parentElement;

            // mengubah button
            if(d.classList.contains('dropdown-item')){
                let btn = parent.querySelector('button');
                let innerHTML = (d.querySelector('.innerHTML')) ? d.querySelector('.innerHTML').outerHTML : d.innerHTML;
                let height = (btn.querySelector('img')) ? btn.querySelector('img').getAttribute('height') : false;
                btn.innerHTML = innerHTML;
                if(height) btn.querySelector('img').setAttribute('height', height);
                Array.from(btn.querySelectorAll('.label')).map(e => e.classList.remove('d-none'))
            }

            // mengganti element active
            singleActiveClass(d, 'active', d.parentElement.children)

            // mengubah nilai value dari yang di kirim
            if(d.hasAttribute('value') && parent.querySelector('input')){
                changeAttribute("value", d.getAttribute('value'), parent.querySelector('input'));
            }
        })
    });
})
history.pushState(null, null, location.href);
window.onpopstate = function () {
    history.go(1);
};


























// Fungsi Khusus 
function selectTransactionType (type){
    let transactionCategory = document.getElementById(type+'_categories');
    singleActiveClass(transactionCategory, 'd-none', transactionCategory.parentElement.children, true);
    if(type === 'transfer'){
        document.getElementById('transaction_parties').classList.add('d-none')
    }else{
        transactionCategory.querySelector('input[type=radio]').checked = true;
        document.getElementById('transaction_parties').classList.remove('d-none')
    }
}
function selectAccount (element){
    const all = element.parentElement.querySelectorAll('.saldo');
    singleActiveClass(element.querySelector('.saldo'), 'text-secondary', all, true);
}
function modalClear(element){
    stringToDOM(element);
}
function inputNominal(input, query=''){
    document.querySelector('label[for='+input.id+'] '+query).innerHTML = intFormatID(input.value, 'Nominal');
    if(input.value > 0) document.querySelector('label[for='+input.id+'] .mataUang').classList.remove('d-none');
    else document.querySelector('label[for='+input.id+'] .mataUang').classList.add('d-none');
}
function cutWidth(){
    /*
    # element yang mau kita potong harus memiliki dua attribut
       - name-cut-width   >>merujuk>>   class sebagai pengurang
       - parent-cut-width   >>merujuk>>   query-parent
    # element pengurang harus memiliki 1 class statac (disesuaikan)
       - class sebagai pengurang harus memiliki '.cut-width-' + name-cut-width dari element yang akan di potong
     */
    let all_cut_width = document.querySelectorAll('[name-cut-width]');
    if(all_cut_width.length){
        [...all_cut_width].forEach(cut => {
            let parent = document.querySelector(cut.getAttribute('parent-cut-width'));
            let width_parent = parent.offsetWidth;
            Array.from(parent.querySelectorAll('.cut-width-'+cut.getAttribute('name-cut-width')))
              .forEach(c => {
                width_parent -= c.offsetWidth;
              });
            cut.style.width = width_parent+'px';
        })
    }
}





// Fungsi utama untuk memfilter elemen berdasarkan elemen dengan `filtertarget`
function applyFilter(filterElement) {

    const targetSelector = filterElement.getAttribute('target-filter');
    const targetElement = document.querySelector(targetSelector);

    if (!targetElement) return; // Jika target tidak ditemukan, keluar dari fungsi
    
    const filterInputs = Array.from(filterElement.querySelectorAll('input, select, textarea'));
    const targetItems = Array.from(targetElement.querySelectorAll('.list')); // Contoh class 'task'
    const countItem = targetItems.length;
    
    targetItems.forEach(list => {
        // kita cek semua filternya
        list.classList.remove('d-none');
        filterInputs.forEach(filter => {
            if(!filter.hasAttribute('special')){
                if(filter.value !== '' && list.hasAttribute(filter.getAttribute('name'))){
                    let list_value = list.getAttribute(filter.getAttribute('name'));
                    if(!list_value.includes(filter.value)) list.classList.add('d-none');
                }
            }else{
                switch (filter.getAttribute('special')) {
                    case 'sort':
                        console.log(targetElement.querySelector('ul'));
                        
                        // urutkan berdasarkan apa. dan caranya membaat element baru, dan di masukkan kedalam targetElement
                        // untuk sekarang cuman 
                        if(filter.value === 'desc') targetElement.querySelector('ul').classList.add('flex-column-reverse');
                        else if(filter.value === 'lat') targetElement.querySelector('ul').classList.remove('flex-column-reverse');
                        break;
                }
            }
        });
    });
   
    if(targetElement.querySelectorAll('.list.d-none').length === countItem) targetElement.querySelector('.allHidden').classList.remove('d-none');
    else targetElement.querySelector('.allHidden').classList.add('d-none');
}
