<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.meta')
    <title>@yield('page-title','HomePage')</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>

</head>

<body id="homepage">

<div id="wrapper">
    <!-- header begin -->
    @include('layouts.partials.header')
    <!-- header close -->
    <!-- content begin -->

    <div id="content" class="no-bottom no-top">

       @yield('main-content')

    </div>


    <!-- footer begin -->
    @include('layouts.partials.footer')
    <!-- footer close -->

    <a href="#" id="back-to-top"></a>
</div>

<!-- style switcher
================================================== -->


<div id="switcher">
    <span class="custom-close"></span>
    <span class="custom-show"></span>

    <span class="sw-title">Header Style</span>
    <select name="switcher" id="de-header-style">
        <option value="opt-1">Solid</option>
        <option value="opt-2" selected="">Transparent</option>
    </select>

    <div class="clearfix"></div>

    <span class="sw-title">Header Layout</span>
    <select name="switcher" id="de-header-layout">
        <option value="opt-1">Simple</option>
        <option value="opt-2" selected="">Extended</option>
    </select>

    <div class="clearfix"></div>

    <span class="sw-title">Menu Style</span>
    <select name="switcher" id="de-menu">
        <option value="opt-1">Dotted Separator</option>
        <option value="opt-2">Line Separator</option>
        <option value="opt-3">Circle Separator</option>
        <option value="opt-4">Square Separator</option>
        <option value="opt-5">Plus Separator</option>
        <option value="opt-6">Strip Separator</option>
        <option value="opt-0" selected="">No Separator</option>
    </select>

    <div class="clearfix"></div>

    <span class="sw-title">Color :</span>
    <ul id="de-color">
        <li class="bg1"></li>
        <li class="bg2"></li>
        <li class="bg3"></li>
        <li class="bg4"></li>
        <li class="bg5"></li>
        <li class="bg6"></li>
        <li class="bg7"></li>
        <li class="bg8"></li>
        <li class="bg9"></li>
        <li class="bg10"></li>
    </ul>
</div>

@include('layouts.partials.scripts')
@include('components.alert')
</body>
</html>
