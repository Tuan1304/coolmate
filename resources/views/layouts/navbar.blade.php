<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('home')}}">Tổng quan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('order.create')}}">TT Đơn hàng</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('category.create')}}">Danh mục hàng</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{route('collection.create')}}">Bộ sưu tập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('children.create')}}">Thời trang trẻ em</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('man.create')}}">Thời trang nam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('women.create')}}">Thời trang nữ</a>
        </li>
        {{-- <li class="nav-item active">
          <a class="nav-link" href="{{route('category.create')}}">Loại sản phẩm</a>
        </li> --}}
        
        <li class="nav-item">
            <a class="nav-link" href="{{route('product.create')}}">Sản phẩm</a>
        </li>
        {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> --}}
        
      </ul>
      <form class="form-inline my-2 my-lg-0" style="display:flex;">
        <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>