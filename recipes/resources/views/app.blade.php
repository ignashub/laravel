<!doctype html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
<ul>
    <li><a href="/recipes">Recipes</a> </li>
    <li><a href="/overview">Overview</a> </li>
</ul>
@yield ('content')
</body>
</html>
<style>

    body {
        background: black;
    }
    h1 {
        color: red;
        margin-left: 500px;
        margin-top: 100px;
    }
    p{
        color: red;
    }
    a {
        color: red;
    }
    li {
        color: red;
    }
</style>