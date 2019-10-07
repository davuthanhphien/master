<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head_meta')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('admin.partials.header')

    @include('admin.partials.aside')

    <div class="content-wrapper">

        <section class="content-header">

            @include('admin.message')

            @yield('content')

        </section>

        <section class="content container-fluid">

        </section>

    </div>

   @include('admin.partials.footer')
</div>
    @include('admin.partials.footer_script')
@stack('scripts')
</body>
</html>
