@extends('layout')
@section('content')
<!-- product detail -->
<section class="product-detail p-to-top">
    <div class="container">
        <div class="product-top">
            <p>Sản Phẩm</p><span>&#47;</span><p style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">{{$product->title}}</p>
        </div>
        <div class="row-grid">
            <div class="product-detail-left">
                <img class="main-img" src="{{asset('uploads/product/'.$product->image)}}" alt="">
                <div class="product-img-item">
                    <img src="{{asset('uploads/product/'.$product->image)}}" alt="">
                    @foreach(explode(',', $product->images) as $imageName)
                        <img src="{{ asset('uploads/images/' . $imageName) }}" alt="">
                    @endforeach
                </div>
            </div>
            <div class="product-detail-right">
                <div class="product-detail-right-infor">
                    <h1>{{$product->title}}</h1>
                    <p>Chất liệu : <span>{{$product->material}}</span></p>
                    <div class="hot-product-item-price">
                        <p>Gía bán : <span>{{number_format($product->price)}}<sup>đ</sup></span></p>
                    </div>
                </div>
                <div class="product-detail-right-color">
                    <p>Màu sắc:</p>
                    <div class="product-detail-right-color-img">
                        <div class="grid-item">
                            <a href=""><img src="{{asset('uploads/product/'.$product->image)}}" alt=""></a>
                            <p>Color-
                            @if ($product->color==0)
                                Đỏ
                            @elseif($product->color==1)
                                Trắng
                            @elseif($product->color==2)
                                Đen
                            @elseif($product->color==3)
                                Xanh Lam
                            @elseif($product->color==4)
                                Xanh Lá
                            @elseif($product->color==5)
                                Be
                            @elseif($product->color==6)
                                Nâu
                            @elseif($product->color==7)
                                Xám
                            @endif</p>
                        </div>
                        {{-- <div class="grid-item"> 
                            <a href=""><img src="{{asset('uploads/product/nu36646.jpg')}}" alt=""></a>
                            <p>Màu đỏ</p>
                        </div>
                        <div class="grid-item">
                            <a href=""><img src="{{asset('uploads/product/nu12414.webp')}}" alt=""></a>
                            <p>Màu đỏ</p>
                        </div> --}}
                    </div>
                </div>
                
                <form action="{{route('cart_add')}}" method="GET">
                    <div class="product-detail-right-size">
                        <p style="padding-bottom:7px">Size:</p>
                        <select name="product_size" class="size-class">
                            <option class="box" value="S">S</option>
                            <option class="box" value="M">M</option>
                            <option class="box" value="L">L</option>
                            <option class="box" value="XL">XL</option>
                            <option class="box" value="XXL">XXL</option>
                        </select>                        
                    </div>
                    <div class="product-detail-right-quantity">
                        <h2>Số Lượng:</h2>
                        <div class="product-detail-right-quantity-input">
                            <i class="ri-subtract-line"></i>
                            <input class="quantity-input" onkeydown="return false" name="product_qty" type="number" value="1">
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <i class="ri-add-line"></i>
                        </div>
                    </div>
                    <div class="product-detail-right-addcart">
                        <button type="submit" class="main-btn">Thêm vào giỏ hàng</button>
                        {{-- so sánh giá cả --}}
                        <button class="sosanh-btn">So sánh giá cả</button>
                        <div id="popup" class="popup">
                            <div class="popup-content">
                                <span class="close-btn">&times;</span>
                                <iframe id="popup-iframe" src="" frameborder="0"></iframe>
                            </div>
                        </div>
                        {{-- <div id="popup" class="popup">
                            <div class="popup-content">
                                <span class="close-btn">&times;</span>
                                <div id="popup-body"></div>
                            </div>
                        </div> --}}
                    </div>
                </form>
                <div class="product-content-right-bottom">
                    <div class="product-content-right-bottom-top">
                        &#8744;
                    </div>
                    <div class="product-content-right-bottom-content-big">
                        <div class="product-content-right-bottom-content-title row-flex">
                            <div class="product-content-right-bottom-content-title-item chitiet">
                                <p>Giới thiệu</p>
                            </div>
                            <div class="product-content-right-bottom-content-title-item baoquan">
                                <p>Bảo Quản</p>
                            </div>
                            <div class="product-content-right-bottom-content-title-item danhgia">
                                <p>Đánh Gía Sản Phẩm</p>
                            </div>
                        </div>
                        <div class="product-content-right-bottom-content">
                            <div class="product-content-right-bottom-content-chitiet">
                                Sản phẩm nên được bảo quản ở nơi khô ráo, sạch sẽ như trên các kệ, tử sách. <br>
                                Khi đọc không nên làm quăn sách, xé sách, sách là tri thức chúng ta nên nâng niu! <br>
                                Quần áo được làm từ cotton bền và thoáng tạo cảm giác thoải mái cho người mặc <br>
                            </div>
                            <div class="product-content-right-bottom-content-baoquan">
                                Quần áo nên được để ở nơi khô ráo tránh nơi ẩm thấp, bẩn <br>
                                Khi giặt xong nên phơi ngay!
                            </div>
                            {{-- <div class="product-content-right-bottom-content-danhgia">
                                <ul class="list-inline rating"  title="Average Rating">

                                    @for($count=1; $count<=5; $count++)

                                      @php

                                        if($count<=$rating){ 
                                          $color = 'color:#ffcc00;'; //mau vang
                                        }
                                        else {
                                          $color = 'color:#ccc;'; //mau xam
                                        }
                                      
                                      @endphp
                                    
                                      <li title="star_rating" 

                                      id="{{$product->id}}-{{$count}}" 
                                      
                                      data-index="{{$count}}"  
                                      data-product_id="{{$product->id}}" 

                                      data-rating="{{$rating}}" 
                                      class="rating" 
                                      style="cursor:pointer; {{$color}} 

                                      font-size:50px;">&#9733;</li>

                                    @endfor

                                </ul>
                                <p class="total_rating">Đánh giá : {{$rating}}/{{$count_total}} lượt</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="product-detail-content" style="padding-top: 12px">
            <div class="product-detail-right-des">
                <h2 class="heading-text-pro ">Đặc điểm nổi bật</h2>
                <ul>
                    <li>{!! $product->description !!}</li>
                    {{-- <li>Thành phần: 100% Polyester, định lượng 40gsm</li>
                    <li>Kiểu dệt: Teffeta Ripstop Woven</li>
                    <li>Vải có tính năng trượt nước, chịu được các cơn mưa nhỏ</li>
                    <li>Vải xử lí hoàn thiện tính năng Nhanh khô (Quick-Dry)</li>
                    <li>Trọng lượng áo siêu nhẹ chỉ 130 gam (cỡ 3XL)</li>
                    <li>Áo mỏng giúp việc thoát hơi và làm khô nhanh hơn</li>
                    <li>Tự hào sản xuất tại Việt Nam</li>
                    <li>Người mẫu: 182 cm - 77kg, mặc áo 2XL, quần 2XL</li> --}}
                </ul>
            </div>
        </div>

        
    </div>
</section>
        
{{-- comment fb --}}
    <div class="container" style="padding-top: 12px">
        <div class="row-grid">
            <p class="heading-text-coment">Bình luận</p>
        </div>
        @php
            $current_url = Request::url();
        @endphp
        <div class="coment-fb" style="text-align: center;">
            <div class="fb-comments" data-href="{{$current_url}}" data-width="100%" data-numposts="10" ></div>
        </div>
    
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0" nonce="utFjC71h"></script>
    </div>




<!-- Relate Product -->
<section class="hot-products" style="padding-top: 12px">
    <div class="container">
        <div class="row-grid">
            <p class="heading-text-pro">Có thể bạn cũng thích</p>
        </div>
        <div class="row-grid row-grid-hot-products">
            @foreach ($related->take(5) as $key => $pro)
            <div class="hot-product-item">
                <a href="{{route('product',$pro->slug)}}"><img src="{{asset('uploads/product/'.$pro->image)}}" alt=""></a>
                @if (!empty($pro->collection))
                    <a href="{{route('collection',$pro->collection->slug)}}" class="test-anh"><img src="{{asset('uploads/collection/icon/'.$pro->collection->icon)}}" style="z-index: 0"></a>
                @endif
                <p><a href="{{route('product',$pro->slug)}}">{{$pro->title}}</a></p>
                <span>{{$pro->material}}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

    {{-- click product img detail --}}
    <script type='text/javascript'> 
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
    </script>

    {{-- Số lượng SP --}}
    <script type='text/javascript'> 
        const quanPlus = document.querySelector('.ri-add-line')
        const quanMinus = document.querySelector('.ri-subtract-line')
        const quantityInput = document.querySelector('.quantity-input')
        let qty = 1
        if(quanMinus != null && quanPlus != null){
            quanPlus.addEventListener('click',()=>{
                inputValue = 
                qty++
                quantityInput.value = qty
            })
            quanMinus.addEventListener('click',()=>{
                if(qty <= 1){
                    return false
                } else {
                    qty--
                    quantityInput.value = qty
                }
            })
        }
    </script>

    {{-- đánh giá sản phẩm --}}
    <script type="text/javascript">
        
        function remove_background(product_id)
         {
          for(var count = 1; count <= 5; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ccc');
          }
        }

        //hover chuột đánh giá sao
       $(document).on('mouseenter', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
        // alert(index);
        // alert(product_id);
          remove_background(product_id);
          for(var count = 1; count<=index; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ffcc00');
          }
        });
       //nhả chuột ko đánh giá
       $(document).on('mouseleave', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
          var rating = $(this).data("rating");
          remove_background(product_id);
          //alert(rating);
          for(var count = 1; count<=rating; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ffcc00');
          }
         });

        //click đánh giá sao
        $(document).on('click', '.rating', function(){
           
              var index = $(this).data("index");
              var product_id = $(this).data('product_id');
          
              $.ajax({
               url:"{{route('add-rating')}}",
               method:"POST",
               data:{index:index, product_id:product_id},
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               success:function(data)
               {
                if(data == 'done')
                {
                 
                 alert("Bạn đã đánh giá "+index +" trên 5");
                 location.reload();
                 
                }else if(data =='exist'){
                  alert("Bạn đã đánh giá phim này rồi,cảm ơn bạn nhé");
                }
                else
                {
                 alert("Lỗi đánh giá");
                }
                
               }
              });
            
            
              
        });

   
    </script>

    {{-- Size --}}
    <script type='text/javascript'> 
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
    </script>

    {{-- Bảo quản và chi tiết --}}
    <script type='text/javascript'> 
        const baoquan = document.querySelector(".baoquan")
        const chitiet = document.querySelector(".chitiet")
        const danhgia = document.querySelector(".danhgia")
        if(baoquan) {
            baoquan.addEventListener("click", function() {
                document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
                document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
                document.querySelector(".product-content-right-bottom-content-danhgia").style.display = "none"
            })
        }
        if(chitiet) {
            chitiet.addEventListener("click", function() {
                document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
                document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
                document.querySelector(".product-content-right-bottom-content-danhgia").style.display = "none"
            })
        }
        if(danhgia) {
            danhgia.addEventListener("click", function() {
                document.querySelector(".product-content-right-bottom-content-danhgia").style.display = "block"
                document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
                document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
            })
        }
        const button = document.querySelector(".product-content-right-bottom-top")
        if(button) {
            button.addEventListener("click", function() {
                document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB")
            })
        }

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
    </script>

    {{-- So sánh giá cả sản phẩm --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var btn = document.querySelector(".sosanh-btn");
            var popup = document.getElementById("popup");
            var closeBtn = document.querySelector(".close-btn");
            var iframe = document.getElementById("popup-iframe");

            btn.addEventListener("click", function(event) {
                event.preventDefault();
                iframe.src = "{{$product->compare}}"; // Đặt URL của bạn vào đây
                popup.style.display = "block";
            });

            closeBtn.addEventListener("click", function() {
                popup.style.display = "none";
                iframe.src = ""; // Đặt lại src để ngừng tải trang khi đóng popup
            });

            window.addEventListener("click", function(event) {
                if (event.target === popup) {
                    popup.style.display = "none";
                    iframe.src = ""; // Đặt lại src để ngừng tải trang khi đóng popup
                }
            });
        });




    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var btn = document.querySelector(".sosanh-btn");
            var popup = document.getElementById("popup");
            var closeBtn = document.querySelector(".close-btn");
            var popupBody = document.getElementById("popup-body");

            btn.addEventListener("click", function(event) {
                event.preventDefault();
                fetchPageContent("https://saigonapp.com/thiet-ke-web/?gad_source=1&gclid=CjwKCAjwr7ayBhAPEiwA6EIGxFLB_E1fBgwb6KCVWhLhr7aqDLTqqF9XdjyabJkCDpDWWk-Zuakp9xoCkKYQAvD_BwE");
                popup.style.display = "block";
            });

            closeBtn.addEventListener("click", function() {
                popup.style.display = "none";
                popupBody.innerHTML = ""; // Xóa nội dung khi đóng popup
            });

            window.addEventListener("click", function(event) {
                if (event.target === popup) {
                    popup.style.display = "none";
                    popupBody.innerHTML = ""; // Xóa nội dung khi đóng popup
                }
            });

            function fetchPageContent(url) {
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        var parser = new DOMParser();
                        var doc = parser.parseFromString(data, 'text/html');
                        var content = doc.querySelector('.product-details'); // Tùy chỉnh selector để lấy nội dung mong muốn
                        popupBody.innerHTML = content ? content.innerHTML : "Không thể tải nội dung.";
                    })
                    .catch(error => {
                        console.error('Error fetching the page:', error);
                        popupBody.innerHTML = "Đã xảy ra lỗi khi tải nội dung.";
                    });
            }
        });

    </script> --}}

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var btn = document.querySelector(".sosanh-btn");
            var popup = document.getElementById("popup");
            var closeBtn = document.querySelector(".close-btn");

            btn.addEventListener("click", function(event) {
                event.preventDefault();
                window.open("https://routine.vn/quan-jean-nam-ong-om-xanh-tron-form-slim-10s24dpa005.html", "_blank");
                popup.style.display = "block";
            });

            closeBtn.addEventListener("click", function() {
                popup.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target === popup) {
                    popup.style.display = "none";
                }
            });
        });

    </script> --}}

@endsection