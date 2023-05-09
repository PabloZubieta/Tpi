<?php
/**
 * @file creation.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 09.05.2023
 */
$title = "Création"
?>
@extends('layout')

@section('content')
    <div >
        <div class="container col-lg-12 col-md-12 col-sm-12 " >
            <div class="row" >
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <h4>Les Explications</h4>
                    <p>
                        Vous voici dans l'interface de création des labyrinthes. elle vous permet de créer vos propres labyrinthe.
                        Vous pourez les faire valider avant les enregister dans la base de donnée. vous avec prealablement chosis la taille du labyrinthe.
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" >
                    <div >
                        <form  method="POST" action="/check">
                            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
                            <div class="mb-3">
                                <input type="text"  name="labyrinthe_code"  value="" hidden>
                            </div>
                            <div class="mb-3">
                                <input type="number"  name="lenght"  value="" hidden>
                            </div>
                            <div class="mb-3">
                                <input type="number"  name="height"  value="" hidden>
                            </div>
                            <div id="submit" >
                                <button type="submit" name="Valider" class="btn btn-primary col-12 m-3">Valider</button>

                                <button type="reset" name="Reset" class="btn btn-primary col-12  m-3">Reset</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="row" >
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <h4>Les Tuiles</h4>


                </div>
                <div class="col-lg-8 col-md-12 col-sm-12" >
                    <h4>Le Labyrinthe</h4>

                </div>
            </div>


        </div>

    </div>
@endsection
