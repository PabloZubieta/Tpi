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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
            <li class="nav-item"><a class="nav-link" href="/creation" style="color:#386641">Création</a></li>
            <li class="nav-item"><div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-color: white;background-color: white; box-shadow:0 0">
                        Résolution
                    </button>
                    <form class="dropdown-menu p-4" method="post" action="/resolution" >
                        @csrf
                        <div class="form-group">
                            <label for="length">Longueur</label>
                            <input type="number" class="form-control" id="length2" name="length" required >
                            @error('length')
                            <p>{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="height">Hauteur</label>
                            <input type="number" class="form-control" id="height2" name="height" required >
                            @error('height')
                            <p>{{$message}}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-top: 3px">Crée</button>
                    </form>
                </div></li>
            <li class="nav-item"><a class="nav-link" href="/historique" style="color:#386641">Historique</a></li>
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
