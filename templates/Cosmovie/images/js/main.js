const bigswiper = new Swiper('.bigslidersect .swiper', {
    loop: true,
    slidesPerView: 1,
    scrollbar: {
        el: '.swiper-scrollbar',
        draggable: true,
    },
    navigation: {
        nextEl: '.bigslidersect .swiper-button-next',
        prevEl: '.bigslidersect .swiper-button-prev',
    },
    spaceBetween: 10,
    breakpoints: {
        980: {
            spaceBetween: 30,
        },
    }

})

let minisliderconf = {
    spaceBetween: 20,
    slidesPerGroup: window.innerWidth <= 1023 ? 3: 1,
    freeMode: window.innerWidth <= 1023 || false,
    breakpoints: {
        320: {
            slidesPerView: 'auto',
        },
        1024: {
            slidesPerView: 4,
            slidesPerGroup: 3,
        },
        1280: {
            slidesPerView: 5,
            slidesPerGroup: 3,
        },
        1440: {
            slidesPerView: 6,
            slidesPerGroup: 3,
        },
        1600: {
            slidesPerView: 7,
            slidesPerGroup: 3,
        },
    },
    navigation: {
        nextEl: '',
        prevEl: '',
    },
};
let collectsliderconf = {
    slidesPerView: 'auto',
    spaceBetween: 20,
    slidesPerGroup: 2,
    freeMode: true,
    navigation: {
        nextEl: '.swipbuttons5 .swiper-button-next',
        prevEl: '.swipbuttons5 .swiper-button-prev',
    },
};

function minisliderconfig(selector) {
    minisliderconf.navigation.nextEl = selector + ' .swiper-button-next';
    minisliderconf.navigation.prevEl = selector + ' .swiper-button-prev';
    return minisliderconf;
}

const swiper1 = new Swiper('main .minislider1', minisliderconfig('.swipbuttons1'));
const swiper2 = new Swiper('main .minislider2', minisliderconfig('.swipbuttons2'));
const swiper3 = new Swiper('main .minislider3', minisliderconfig('.swipbuttons3'));
const swiper4 = new Swiper('main .minislider4', minisliderconfig('.swipbuttons4'));
const swiper5 = new Swiper('main .minislider5', collectsliderconf);


let ajaxInfoBtns = document.querySelectorAll('.fa-info');
let InfoBtns = [];
for (const ajaxInfoBtn of ajaxInfoBtns) {
    ajaxInfoBtn.onmouseover = function (e) {
        let targetElem = e.target.getAttribute('data-id')
        if (!InfoBtns.includes(targetElem)) {
            console.log(getAjaxInfo(targetElem))
            InfoBtns.push(targetElem)
            e.target.classList.add("loading");
        }
        if (e.target.getBoundingClientRect().left < window.innerWidth - e.target.getBoundingClientRect().right) {
            e.target.parentElement.lastElementChild.style.left = '187px'
        } else {
            e.target.parentElement.lastElementChild.style.right = '187px'
        }
    }
    ajaxInfoBtn.onmouseout = function (e) {
        e.target.classList.remove("loading");
    }
    ajaxInfoBtn.onclick = function (e) {
        e.preventDefault()
    }
}

function getAjaxInfo(targetElem) {
    return targetElem + ' Ajax запрос информации';
}

let searchbtn = document.querySelector('#navrigthsect button')
let searchrow = document.querySelector('#navrigthsect form input')
let clickcount = 0
searchbtn.onclick = function (e) {
    if (!searchrow.value) e.preventDefault()
    if (!clickcount) {
        console.log(123)
        searchrow.parentElement.classList.add('searchrowActive')
        searchbtn.style.color = 'black'
        searchbtn.style.zIndex = '52'
        searchrow.style.left = 0
        clickcount = 1
        searchrow.focus()
    } else {
        clickcount = 0
        searchrow.blur()
    }
}
searchrow.onblur = function (e){
    if (clickcount) {
        console.log(321)
        searchrow.parentElement.classList.remove('searchrowActive')
        searchbtn.style.color = 'white'
        searchrow.style.left = '100%'
        if (e.relatedTarget != searchbtn) clickcount = 0
    }
}



let logBtn = document.querySelector('#log button')


logBtn.onclick = function () {
    alert('Функционал регистрации пока что не реализован')
}
let stars_cont = document.querySelector('#stars')
let stars = document.querySelectorAll('#stars a')
let empty_stars = document.querySelectorAll('#empty-stars span')
if (stars_cont){
    let star_prev_value = 10 - Number(stars_cont.getAttribute('data-id'))
    let colors = ['#ff0000','#ff4300','#ff7d00','#ff9f00','#ffaa00','#ffc000','#ffe200','#efff00','#b7ff00','#19ff00'].reverse()

    function stars_color_decide(star_position) {
        stars_cont.style.width = (10 - star_position) * 10 + '%';
        stars.forEach((value, key) => {
            value.style.color = colors[Math.round(star_position)];
            (star_position == 0) ? value.style.textShadow = '0 0 7px #35abff': value.style.textShadow = 'none'
        })

    }
    stars_color_decide(star_prev_value)
    stars.forEach((value, key) => {
        value.onclick = (e) => { e.preventDefault(); stars_color_decide(key); star_prev_value = key}
        value.onmouseover = () =>  stars_color_decide(key);
        value.onmouseout = () => stars_color_decide(star_prev_value);
    })
    empty_stars.forEach((value, key) => value.onmouseover = () => stars_cont.style.width = (10 - key) * 10 + '%')

}

let page_up_btn = document.querySelector('#page_up')
page_up_btn.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}
window.addEventListener('scroll', function(e) {
    page_up_btn_toggle()
});
function page_up_btn_toggle() {
    if (window.scrollY > 500) {
        page_up_btn.style.visibility = 'visible';
        page_up_btn.style.opacity = '1'
    }
    else if (window.scrollY < 500){
        page_up_btn.style.opacity = '0';
        page_up_btn.style.visibility = 'hidden'
    }
}
let burgerbtn = document.querySelector('#burgerbtn')
let navbar = document.querySelector('header nav')
let burgerClickCount = 0;
burgerbtn.onclick = function (){
    if (!burgerClickCount) {
        searchbtn.style.zIndex = 'inherit';
        navbar.style.left = 0;
        document.body.style.overflowY = 'hidden'
        burgerbtn.style.position = 'absolute'
        burgerClickCount = 1;
    } else {
        burgerbtn.style.position = 'static'
        navbar.style.left = '-100vw';
        document.body.style.overflowY = 'auto'
        //navbar.style.right = '100%';
        burgerClickCount = 0
    }
}
let lihassubmenu = document.querySelectorAll('.hassubmenu')
let submenusHeaderClickCount = 0
let lastOpenMenu = false
function ismobile() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}
lihassubmenu.forEach((elem) => {
    elem.onclick = function (){
        if (ismobile()){
            console.log(String(elem.classList).indexOf('hassubmenuActive'))
            if (String(elem.classList).indexOf('hassubmenuActive') < 1){
                elem.classList.add('hassubmenuActive')
                elem.lastElementChild.style.height = '720px'
                elem.firstElementChild.lastElementChild.style.transform = 'rotate3d(1,0,0,180deg)'
            } else {
                elem.classList.remove('hassubmenuActive')
                elem.lastElementChild.style.height = 0
                elem.firstElementChild.lastElementChild.style.transform = 'rotate3d(1,0,0,0deg)'
            }
        }

    }
    elem.onmouseout = function (){
        if (ismobile()){
            elem.classList.remove('hassubmenuActive')
            elem.lastElementChild.style.height = 0
            elem.firstElementChild.lastElementChild.style.transform = 'rotate3d(1,0,0,0deg)'
        }
    }
})




// let lastOpenMenu = false

// submenusHeader.forEach((elem) => {
    // elem.onmouseout = () => {
    //     !ismobile() || hideSubmenu(elem);
    //     !ismobile() ? submenusHeadersClickCount = 0: 1;
    //     console.log(456)
    // }
    // elem.onmouseout = () => {
    //     hideSubmenu(elem)
    // }
    // elem.onclick = () => {
    //     // if(lastOpenMenu) {
    //     //     hideSubmenu(lastOpenMenu)
    //     //     submenusHeadersClickCount = 0
    //     // }
    //     if (submenusHeaderClickCount) {
    //         lastOpenMenu = elem
    //         hideSubmenu(lastOpenMenu)
    //     }
    //     if (elem != lastOpenMenu) showSubmenu(elem)
    //
    //     if (lastOpenMenu) hideSubmenu(lastOpenMenu)
    //     showSubmenu(elem)
    //
    // }
// })
// function hideSubmenu(elem) {
//     if (window.innerWidth <= 1023){
//         console.log(123)
//         elem.parentElement.lastElementChild.style = 'visibility: hidden; height: 0;'
//         elem.lastElementChild.style.transform = 'rotate3d(1,0,0,0deg)';
//         submenusHeaderClickCount = 0
//     }
// }
// function showSubmenu(elem) {
//     if (window.innerWidth <= 1023){
//         console.log(321)
//         elem.parentElement.lastElementChild.style = 'visibility: visible; height: 730px;'
//         elem.lastElementChild.style.transform = 'rotate3d(1,0,0,180deg)';
//         submenusHeaderClickCount = 1
//     }
// }