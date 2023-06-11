<?php
/**
 * @file interface.blade.php
 * @brief file description
 * @author Created by Blooooo
 * @version 11.06.2023
 */
$title = "Interface"

?>
@extends('layout')

@section('content')

    <div >
        <div class="container col-lg-12 col-md-12 col-sm-12 " >
            <div class="row" >
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <h4 class="d-flex justify-content-center">Les Explications</h4>
                    <p>
                        Vous voici dans l'interface de création. Elle vous permet de créer vos propres labyrinthes.
                        Pour confectionner votre labyrinthe, dans un premier temps, vous devrez entrer les dimensions désirées dans les champs correspondants. Ce qui générera votre grille.
                        <br>
                        Dans un deuxième temps choisirez le point de départ de votre labyrinthe en cliquant sur une des cases de votre grille. Elle sera surlignée de rouge et point d’arrivée. (! Attention le point d’arrivée doit se trouver en bordure du labyrinthe : sinon il vous serait impossible de vous enfuir)
                        <br>
                        Et voilà laisser libre cours à votre imagination, et inventez de machiavéliques dédales aux contours sinistres et inquiétants.
                        En Drag-and-dropant les tuiles dans votre grille.
                        Il ne vous reste plus qu’à valider votre labyrinthe.
                    </p>


                </div>
                <div class="col-lg-3 col-md-3 col-sm-12" >
                    <div >
                        <form  method="POST" action="/check">
                            @csrf <!-- juste de la securité  https://laravel.com/docs/5.8/csrf -->
                            <div class="mb-3">
                                <input type="text"  name="labyrinthe_code" id="labyrinthe_code" value="{{old('labyrinthe_code')}}" hidden>
                            </div>
                            <div class="mb-3">
                                <input type="number"  name="length" id="length" value="{{old('length')}}" hidden>
                            </div>
                            <div class="mb-3">
                                <input type="number"  name="height" id="height" value="{{old('height')}}" hidden>
                            </div>
                            <div id="submit" >
                                <button type="submit" name="Valider" class="btn btn-primary col-12 m-3">Valider</button>


                            </div>
                        </form>
                        <button  name="Reset" class="btn btn-primary col-12  m-3" onclick="resetLab()">Reset</button>
                    </div>

                </div>
            </div>
            <div class="row" >

                <div class="col-lg-12 col-md-12 col-sm-12" >
                    <h4 class="d-flex justify-content-center">Le Labyrinthe</h4>
                    <div id="config">
                        <div class="row">
                            <div class="col-8 row">
                                <div class="col-6">
                                    <label>Longueur</label><br>
                                    <input id="setlength" type="number"  name="setlength">
                                </div>
                                <div class="col-6">
                                    <label>Hauteur</label><br>
                                    <input id="setheight" type="number"  name="setheight">
                                </div>
                            </div>
                            <div class="col-4">

                                <button class="btn btn-primary col-12 m-3 " onclick="displayTable()">Créer la grille</button>
                            </div>
                        </div>




                        <p id="erreur">

                        </p>
                    </div>
                    <div class="d-flex justify-content-center" id="maze"></div>

                </div>
            </div>


        </div>

    </div>

    <script>



        let table_array=[];
        let length_min =4
        let height_min =4
        let length_max =10
        let height_max =10
        function resetLab()
        {

            table_array=[]
            let element =document.querySelector('#maze')
            element.removeChild(element.firstChild)
            conf= false;
            document.querySelector('#config').style.display = "block";


        }



        function beginAndEnd(id)
        {

            let value =0
            for(let i = 0; i <document.querySelector('#setheight').value;i++)
            {

                for(let j = 0; j <document.querySelector('#setlength').value;j++)
                {
                    value+=table_array[i][j]

                }


            }
            let cell = id.split('_')
            if(value==0){
                table_array[parseInt(cell[0])][parseInt(cell[1])]+=16
                document.getElementById(id).style.background = "red";
            }
            if((value==16 && table_array[parseInt(cell[0])][parseInt(cell[1])]!==16) && ((parseInt(cell[0])===0 || parseInt(cell[0])===table_array.length-1)||(parseInt(cell[1])===0 || parseInt(cell[1])===table_array[0].length-1) )){
                table_array[parseInt(cell[0])][parseInt(cell[1])]+=32
                document.getElementById(id).style.background = "blue";
                conf = true

            }


        }

        function displayTable()
        {
            let length = document.querySelector('#setlength').value
            let height = document.querySelector('#setheight').value
            if ((length>length_min-1 && length<=length_max)&& (height>height_min-1 && height<=height_max ))
            {

                let table ="";

                for(let i = 0; i <2;i++)
                {
                    table += "<tr >"
                    let row =[]
                    for(let j = 0; j <2;j++)
                    {
                        table +="<td id='"+i+"_"+j+"' class='cells' >" +
                            "<div class='container justify-content-center' >"+
                        '<div class="row">'+
                                    '<div class="col-4">'+
                                    '</div>'+
                                    '<div class="col-4" onclick="get_Me_Out(1)">'+
                                        '<p>&uarr;</p>'+
                                    '</div>' +
                                    '<div class="col-4">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-4" onclick="get_Me_Out(8)">'+
                                        '<p >&larr;</p>'+
                                    '</div>'+
                                    '<div class="col-4">'+
                                    '</div>'+
                                    '<div class="col-4" onclick="get_Me_Out(2)">'+
                                        '<p>&rarr;</p>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-4">'+
                                    '</div>'+
                                    '<div class="col-4" onclick="get_Me_Out(4)">'+
                                        '<p>&darr;</p>'+
                                    '</div>'+
                                    '<div class="col-4">'+
                                    '</div>'+
                                '</div>' +
                            "</div>"+
                            "</td>"
                        row.push(0)
                    }
                    table += "</tr>"
                    table_array.push(row)
                }
                const maze = document.createElement('table')
                maze.classList.add('maze')
                maze.innerHTML=table;
                document.querySelector('#length').value = length
                document.querySelector('#height').value = height

                document.querySelector('#maze').append(maze);
                document.querySelector('#config').style.display = "none";

            }else
            {
                document.querySelector('#erreur').innerText= "La taille minimal du labyrinthe doit être de 4x4.\n Sa taille maximal est de 10x10" +
                    "\n les valeurs que vous avez entrer ne sont pas conforme a une de ses deux normes";
            }
        }
    </script>
    <style>
        .cells{
            background-image: url("asset_graphique/0.png");
            background-repeat: no-repeat;
            background-size: cover;
            height: 128px;
            width: 128px;
        }


    </style>
@endsection
