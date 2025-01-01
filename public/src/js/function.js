console.log('file function.js sudah load');
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
// Fungsi Umum
document.addEventListener('DOMContentLoaded', function(){
    // date
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


    // dropdown
    const dropdown = document.querySelectorAll('.dropdown-item');
    [...dropdown].forEach(dropdown => {
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
    document.querySelector('label[for='+input.id+'] .mataUang').classList.add('d-none');
    if(input.value > 0) document.querySelector('label[for='+input.id+'] .mataUang').classList.remove('d-none');
}

