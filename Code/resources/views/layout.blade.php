<?php
/**
 * @file layout.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 04.05.2023
 */
$title= "Get Me Out";
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>{{$title}}</title>
</head>
<body>
<header>


    <h1 class="display-1" style=" text-align: center">Get Me Out</h1>

    @auth
        <div class="right-align" style="text-align:right; margin-right: 5px;color:#386641"><h5>Bienvenue

                {{auth()->user()->username}}


            </h5></div>
    @endauth
</header>
<nav>
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>

        @auth
            <li class="nav-item"><a class="nav-link" href="#" style="color:#386641">Création</a></li>
            <li class="nav-item"><a class="nav-link" href="#" style="color:#386641">Résolution</a></li>
            <li class="nav-item"><a class="nav-link" href="#" style="color:#386641">Historique</a></li>
            <li class="nav-item" ><form method="post" action="/logout" style="border-color: white;background-color: white; box-shadow:0 0">
                    @csrf
                    <button class="nav-link" type="submit"  style="color:#386641;border-color: white;background-color: white; box-shadow:0 0" >Logout</button>
                </form></li>
        @else
            <li class="nav-item"><a class="nav-link" href="/login" style="color:#386641">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/register" style="color:#386641">Register</a></li>
        @endauth
    </ul>
</nav>
@yield('content')
<footer>
    <p class="center">Get Me Out of Cpnv la seule application vous apprends à vous sortir de l'ICT 151 sans trop de cheveux blancs</p>
</footer>
</body>
</html>
