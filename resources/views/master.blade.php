<!DOCTYPE html>
<html lang="en">
<head>
    @include("layouts.head")
</head>
<body>
    <!-- Begin box login -->
    <!-- tạo 1 khung để có thể kế thừa từ các file blade khác -->
    @yield("content")
    <!-- End box login -->
    @include("layouts.footer")
</body>
</html>
