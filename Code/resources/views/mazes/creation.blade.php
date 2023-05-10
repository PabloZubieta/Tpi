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
                    <button class="btn btn-outline-primary"  onclick="hideExemple('#autre')">
                        Croix et autre
                    </button>
                    <button class="btn btn-outline-primary"  onclick="hideExemple('#t')">
                        tuile en T
                    </button>
                    <button class="btn btn-outline-primary"  onclick="hideExemple('#angle')">
                        Angle
                    </button>
                    <button class="btn btn-outline-primary"  onclick="hideExemple('#fin')">
                        Cul-de-Sac
                    </button>
                    <div id="tuile">
                        <div id="autre" class="displaytuile" style="display: block">
                            <img src="asset_graphique/15.png" class="col-6 p-2"><img src="asset_graphique/10.png" class="col-6 p-2">
                            <img src="asset_graphique/5.png" class="col-6 p-2"><img src="asset_graphique/0.png" class="col-6 p-2">

                        </div>
                        <div id="t" class="displaytuile" style="display: none">
                            <img src="asset_graphique/14.png" class="col-6 p-2"><img src="asset_graphique/13.png" class="col-6 p-2">
                            <img src="asset_graphique/7.png" class="col-6 p-2"><img src="asset_graphique/11.png" class="col-6 p-2">

                        </div>
                        <div id="angle" class="displaytuile" style="display: none">
                            <img src="asset_graphique/6.png" class="col-6 p-2"><img src="asset_graphique/12.png" class="col-6 p-2">
                            <img src="asset_graphique/3.png" class="col-6 p-2"><img src="asset_graphique/9.png" class="col-6 p-2">

                        </div>
                        <div id="fin" class="displaytuile" style="display: none">
                            <img src="asset_graphique/4.png" class="col-6 p-2"><img src="asset_graphique/2.png" class="col-6 p-2">
                            <img src="asset_graphique/1.png" class="col-6 p-2"><img src="asset_graphique/8.png" class="col-6 p-2">

                        </div>


                    </div>


                </div>
                <div class="col-lg-8 col-md-12 col-sm-12" >
                    <h4>Le Labyrinthe</h4>
                    <div id="config">
                        <input id="setlenght" type="number"  name="setlenght"  >
                        <input id="setheight" type="number"  name="setheight"  >
                        <button onclick="displayTable()">ok </button>
                        <p id="erreur">

                        </p>
                    </div>
                    <div id="maze">

                    </div>

                </div>
            </div>


        </div>

    </div>

    <script>
        let table_array=[];
        function beginAndEnd(id)
        {

            let value =0
            for(let i = 0; i <document.querySelector('#setheight').value;i++)
            {

                for(let j = 0; j <document.querySelector('#setlenght').value;j++)
                {
                    value+=table_array[i][j]

                }


            }
            let cell = id.split('_')
            if(value==0){
               table_array[parseInt(cell[0])][parseInt(cell[1])]+=16
                document.getElementById(id).style.background = "red";
            }
            if(value==16){
                table_array[parseInt(cell[0])][parseInt(cell[1])]+=32
                document.getElementById(id).style.background = "blue";
            }











        }
        function hideExemple(id)
        {

            const collection = document.getElementsByClassName("displaytuile");
            for (let i = 0; i < collection.length; i++) {
                collection[i].style.display = "none";
            }
            document.querySelector(id).style.display = "block";

        }
        function displayTable()
        {
            if (document.querySelector('#setlenght').value>0 && document.querySelector('#setheight').value>0 )
            {

                let table ="";



                for(let i = 0; i <document.querySelector('#setheight').value;i++)
                {
                    table += "<tr >"
                    let row =[]
                    for(let j = 0; j <document.querySelector('#setlenght').value;j++)
                    {
                        table +="<td id='"+i+"_"+j+"' onclick=\"beginAndEnd('"+i+"_"+j+"')\" >"+i+j+"</td>"
                        row.push(0)
                    }
                    table += "</tr>"
                    table_array.push(row)
                }
                const maze = document.createElement('table')
                maze.classList.add('maze')
                maze.innerHTML=table;


                document.querySelector('#maze').append(maze);
                document.querySelector('#config').style.display = "none";




            }else
            {
                document.querySelector('#erreur').innerText= "les valeur ne sont pas conforme";
            }
        }
    </script>
    <style>
        .maze{

            width: 100%;
        }
    </style>
@endsection
