<!DOCTYPE html>
<html lang="vi">
    @include('admin.layouts.partials.head')
<body>
<div class="wrapper">
    @include('admin.layouts.partials.header')


        <div class="sidebar">
            @include('admin.layouts.partials.sidebar')
        </div>

        <div class="page-content">
            @yield('content')
        </div>
    </div>

</body>
</html>
