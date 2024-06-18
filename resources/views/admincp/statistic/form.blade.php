@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<div class="container">
    <p>Thống kê doanh thu:</p>
    <form autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>

        <div class="col-md-2">
            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
        </div>

        <div class="col-md-2">
            <p>
                Lọc theo:
                <select class="dashboard-filter form-control">
                    <option>--Chọn--</option>
                    <option value="7ngay">7 ngày qua</option>
                    <option value="thangtruoc">Tháng trước</option> 
                    <option value="thangnay">Tháng này</option>
                    <option value="365ngayqua">365 ngày qua</option>
                </select>
            </p>
        </div>

        <div class="col-md-12">
            <div id="chart" class="chart" style="height:250px;"></div>
            {{-- <canvas id="canvas" class="chart" style="height:250px;"></canvas> --}}
        </div>
    </form>

    {{-- <table class="table">
        <p>Thống kê truy cập</p>
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
      
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
    </table> --}}
</div>
<script>
    $( function() {
      $( "#datepicker" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
      });

      $( "#datepicker2" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
      });
    } );
    </script>
    <script>
        $(document).ready(function(){

            chart30daysorder();
            var chart = new Morris.Bar({
                element: 'chart',
                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                fillOpacity: 0.3,
                hideHover: 'auto',
                parseTime: false,
                xkey: 'period',
                ykeys: ['order','sales','profit','quantity'],
                behaveLikeLine: true,
                labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
            });

            function chart30daysorder(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/days-order')}}",
                    method:"POST",
                    dataType:"JSON",
                    data:{_token:_token},
                    success:function(data)
                    {
                        chart.setData(data);
                    }
                });
            }

            $('.dashboard-filter').click(function(){
                var _token = $('input[name="_token"]').val();
                var dashboard_value = $(this).val();
                $.ajax({
                    url:"{{url('/dashboard-filter')}}",
                    method:"POST",
                    dataType:"JSON",
                    data:{dashboard_value:dashboard_value, _token:_token},
                    success:function(data)
                    {
                        chart.setData(data);
                    }
                });
            });

            $('#btn-dashboard-filter').click(function(){
                var _token = $('input[name="_token"]').val();
                
                var form_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                $.ajax({
                    url:"{{url('/filter-by-date')}}",
                    method:"POST", 
                    dataType:"JSON",
                    data:{form_date:form_date, to_date:to_date, _token:_token},
                    success:function(data)
                    {
                        chart.setData(data);
                        // alert('ok');
                        
                    }
                });
            });
            
        });

        
    </script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
@endsection
