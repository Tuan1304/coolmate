const sliderItem = document.querySelectorAll('.slider-item')
for (let index = 0; index < sliderItem.length; index++) {
    sliderItem[index].style.left = index * 100 + "%"
}

const sliderItems = document.querySelector('.slider-items')
const arrowRight = document.querySelector('.ri-arrow-right-line')
const arrowLeft = document.querySelector('.ri-arrow-left-line')
let i = 0
if(arrowRight != null && arrowLeft != null){
    function sliderMove(i){
        sliderItems.style.left = -i*100+"%"
    }
    arrowRight.addEventListener('click',()=>{
        if(i < sliderItem.length - 1){
            i++
            sliderMove(i)
        } else {
            return false
        }
    })
    arrowLeft.addEventListener('click',()=>{
        if(i <= 0){
            return false
        } 
        {
            i--
            sliderMove(i)
        }
    })
    
    function autoSlider(){
        if(i < sliderItem.length-1){
            i++
            sliderMove(i)
            console.log(i)
        } else {
            i = 0
            sliderMove(i)
        }
    }
}
setInterval(autoSlider,3000)


const Menubar = document.querySelector('.header-menu')
const headerNav = document.querySelector('.header-nav')
Menubar.addEventListener('click',()=>{
    headerNav.classList.toggle('active')
})


// striky header
window.addEventListener('scroll',()=>{
    if(scrollY>50){
        document.querySelector('#header').classList.add('active')
    }
    else {
        document.querySelector('#header').classList.remove('active')
    }
})


// click product img detail
const imgSmall = document.querySelectorAll('.product-img-item img')
const imgMain = document.querySelector('.main-img')
for (let index = 0; index < imgSmall.length; index++) {
    imgSmall[index].addEventListener('click',()=>{
        imgMain.src = imgSmall[index].src
        for (let a = 0; a < imgSmall.length; a++) {
            imgSmall[a].classList.remove('active')   
        }
        imgSmall[index].classList.add('active')   
    })
    
}


// quantity product

const quanPlus = document.querySelectorAll('.ri-add-line')
const quanMinus = document.querySelectorAll('.ri-subtract-line')
const quantityInput = document.querySelectorAll('.quantity-input')
let qty = 1
if(quanMinus != null && quanPlus != null){
    for (let index = 0; index < quanMinus.length; index++) {

        quanPlus[index].addEventListener('click',()=>{
            inputValue = quantityInput[index].value
            inputValue++
            quantityInput[index].value = inputValue
        })
        quanMinus[index].addEventListener('click',()=>{
            inputValue = quantityInput[index].value

            if(inputValue <= 1){
                return false
            } else {
                inputValue--
                quantityInput[index].value = inputValue
            }
        })
    }
    
}
// const quanPlus = document.querySelector('.ri-add-line')
// const quanMinus = document.querySelector('.ri-subtract-line')
// const quantityInput = document.querySelector('.quantity-input')
// let qty = 1
// if(quanMinus != null && quanPlus != null){
//     quanPlus.addEventListener('click',()=>{
//         inputValue = 
//         qty++
//         quantityInput.value = qty
//     })
//     quanMinus.addEventListener('click',()=>{
//         if(qty <= 1){
//             return false
//         } else {
//             qty--
//             quantityInput.value = qty
//         }
//     })
// }


// bảo quản và chi tiết
const baoquan = document.querySelector(".baoquan")
const chitiet = document.querySelector(".chitiet")
if(baoquan) {
    baoquan.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
    })
}
if(chitiet) {
    chitiet.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
    })
}
const button = document.querySelector(".product-content-right-bottom-top")
if(button) {
    button.addEventListener("click", function() {
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB")
    })
}



// chọn size sản phẩm
document.addEventListener("DOMContentLoaded", function() {
    var boxes = document.querySelectorAll(".box");

    boxes.forEach(function(box) {
        box.addEventListener("click", function() {
            // Loại bỏ lớp "selected" từ tất cả các div
            boxes.forEach(function(otherBox) {
                otherBox.classList.remove("selected");
            });

            // Thêm lớp "selected" cho div được chọn
            this.classList.add("selected");
        });
    });
});

// Tìm kiếm sản phẩm
$(document).ready(function(){
    $('#timkiem').keyup(function(){
       $('#result').html('');
       var search = $('#timkiem').val();
       if(search!=''){
         $('#result').css('display','inherit'); 
          var expression = new RegExp(search, "i");
          $.getJSON('/json_file/product.json',function(data) {
             $.each(data, function(key, value) {
                if(value.title.search(expression) != -1 || value.description.search(expression) != -1) {
                   $('#result').css('display','inherit');
                   $('#result').append('<li class="search-li" style="cursor: pointer; display: flex; padding: 6px 0; "><img height="70" width="70" style="padding: 0 12px;" class="img-thumbnail" src="/uploads/product/'+value.image+'" alt=""><p>'+value.title+'</p></li>');
                }
             });
          })
       } 
     else {
         $('#result').css('display','none');
       }
    })

    $('#result').on('click','li',function() {
         var click_text = $(this).text().split('->');
         $('#timkiem').val($.trim(click_text[0]));
         $("#result").html('');
         $('#result').css('display','none');
    });
 //    <form action="{{route('tim-kiem')}}" method="GET"><button class="btn btn-primary" ></button></form>
 
    

 })
