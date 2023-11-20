const btn_change = document.querySelector('.btn_change');
const luachon_form = document.querySelector('.LuaChon_form');

if(btn_change != null){
    btn_change.addEventListener('click', function(e){
        console.log(1);
        e.preventDefault;
        luachon_form.classList.toggle('hide');
    })
}

const btn_prev = document.querySelector('.icon_prev');
const btn_next = document.querySelector('.icon_next');

if(btn_prev != null){
    btn_prev.addEventListener('click', function(e){
        e.preventDefault;
        const widthItem = document.querySelector('.bussiness').offsetWidth;
        document.querySelector('.category_search').scrollLeft -= widthItem - 1;
    })
}

if(btn_next != null){
    btn_next.addEventListener('click', function(e){
        e.preventDefault;
        const widthItem = document.querySelector('.bussiness').offsetWidth;
        document.querySelector('.category_search').scrollLeft += widthItem +1;
    })
}