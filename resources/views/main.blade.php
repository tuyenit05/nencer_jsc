<!DOCTYPE html>
<html lang="en">

<head>
    @include("layouts.head")
</head>

<body>
    <div id="main">
        <div class="row">
            <!-- begin sidebar-->
            @include("layouts.sidebar")
            <!-- end sidebar-->
            <div class="col-md-10">
            @include("layouts.header")
            @yield("content")
            </div>
        </div>
    </div>
    @include("layouts.footer")
    @yield("custom-js")
</body>
</html>