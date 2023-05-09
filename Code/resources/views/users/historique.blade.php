<?php
/**
 * @file historique.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 09.05.2023
 */
$title = "Historique";
?>
@extends('layout')

@section('content')
    <div class="container " style="padding-top: 20px;padding-bottom: 30px">

        <div class="row" >
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <h5>Username :
                    </h5>
                    <p>{{auth()->user()->username}}</p>

                </div>

                <div>
                    <div>
                        <h5>Email :</h5>
                        <p>{{auth()->user()->email}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12" >
                <div>
                    <h4>Liste des labyrinthes</h4>

                </div>
            </div>
        </div>




    </div>
@endsection
