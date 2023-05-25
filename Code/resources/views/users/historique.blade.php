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
                    <div class="col-6">
                        <h5>Username :
                        </h5>
                        <p>{{auth()->user()->username}}</p>
                    </div>
                    <div class="col-6">
                        <h5>Email :</h5>
                        <p>{{auth()->user()->email}}</p>
                    </div>


                </div>


            </div>
            <div class="col-lg-6 col-md-12 col-sm-12" >
                <div>
                    <h4>Liste des labyrinthes</h4>
                    <div><h5>Labyrinthes résolu</h5>
                        <table class="table table-striped">
                            <thead>
                            <th>Code</th>
                            <th>Date de résolution</th>
                            <th>Dimension</th>
                            </thead>
                            <tbody>
                            @if($done->isEmpty())
                                <tr>
                                    <td colspan="3">Aucun labyrinthe résolu
                                    </td>

                                </tr>
                            @else
                            @foreach($done as $labyrinthe)
                                <tr onclick="doneLink({{$labyrinthe->id}})">
                                    <td>@if(strlen($labyrinthe->labyrinthe_code)>50)
                                            {{substr($labyrinthe->labyrinthe_code,0,50)}}<br>
                                            {{substr($labyrinthe->labyrinthe_code,50)}}
                                        @else
                                            {{$labyrinthe->labyrinthe_code}}
                                        @endif

                                    </td>
                                    <td>{{$labyrinthe->created_at}}
                                    </td>
                                    <td>{{$labyrinthe->length}}X{{$labyrinthe->height}}
                                    </td>
                                </tr>

                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div><h5>Labyrinthes crée</h5>
                        <table class="table table-striped">
                            <thead>
                            <th>Code</th>
                            <th>Date de création</th>
                            <th>Dimension</th>
                            </thead>
                            <tbody>
                            @if($created->isEmpty())
                                <tr>
                                    <td colspan="3">Aucun labyrinthe crée
                                    </td>

                                </tr>
                            @else
                                @foreach($created as $labyrinthe)
                                    <tr onclick="createLink({{$labyrinthe->id}})">
                                        <td>@if(strlen($labyrinthe->labyrinthe_code)>50)
                                                {{substr($labyrinthe->labyrinthe_code,0,50)}}<br>
                                                {{substr($labyrinthe->labyrinthe_code,50)}}
                                            @else
                                                {{$labyrinthe->labyrinthe_code}}
                                            @endif

                                        </td>
                                        <td>{{$labyrinthe->created_at}}
                                        </td>
                                        <td>{{$labyrinthe->length}}X{{$labyrinthe->height}}
                                        </td>
                                    </tr>

                                @endforeach
                            @endif
                            </tbody>
                        </table></div>


                </div>
            </div>
        </div>




    </div>
    <script>
        function createLink(id){
            location.href = "/resolution/"+id
        }
        function doneLink(id){
            location.href = "/resolution/"+id
        }
    </script>
@endsection
