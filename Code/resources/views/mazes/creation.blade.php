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
    <script>
        let conf= false;
        let table_array=[];
    </script>
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
                    @if (Session::has('message'))
                        <div class="alert alert-danger">
                            Votre labyrinthe est insoluble, désolé.
                            Ressayer d'en créer un.
                        </div>
                        <script>


                        </script>
                    @endif


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
                <div class="col-lg-4 col-md-12 col-sm-12">

                    <h4 class="d-flex justify-content-center">Les Tuiles</h4>
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
                        <div id="autre" class="displaytuile" style="display: block" ondragstart="dragStart(event)">
                            <img src="asset_graphique/15.png" id="15" draggable="true" class="col-6 p-2"><img src="asset_graphique/10.png" draggable="true" id="10" class="col-6 p-2">
                            <img src="asset_graphique/5.png" id="5" draggable="true" class="col-6 p-2"><img src="asset_graphique/0.png" draggable="true" id="0" class="col-6 p-2">

                        </div>
                        <div id="t" class="displaytuile" style="display: none" ondragstart="dragStart(event)">
                            <img src="asset_graphique/14.png" id="14" draggable="true" class="col-6 p-2"><img src="asset_graphique/13.png" draggable="true" id="13" class="col-6 p-2">
                            <img src="asset_graphique/7.png" id="7" draggable="true" class="col-6 p-2"><img src="asset_graphique/11.png" draggable="true" id="11" class="col-6 p-2">

                        </div>
                        <div id="angle" class="displaytuile" style="display: none" ondragstart="dragStart(event)">
                            <img src="asset_graphique/6.png" id="6" draggable="true" class="col-6 p-2"><img src="asset_graphique/12.png" draggable="true" id="12" class="col-6 p-2">
                            <img src="asset_graphique/3.png" id="3" draggable="true" class="col-6 p-2"><img src="asset_graphique/9.png" draggable="true" id="9" class="col-6 p-2">

                        </div>
                        <div id="fin" class="displaytuile" style="display: none" ondragstart="dragStart(event)">
                            <img src="asset_graphique/4.png" id="4" draggable="true" class="col-6 p-2"><img src="asset_graphique/2.png" draggable="true" id="2" class="col-6 p-2">
                            <img src="asset_graphique/1.png" id="1" draggable="true" class="col-6 p-2"><img src="asset_graphique/8.png" draggable="true" id="8" class="col-6 p-2">

                        </div>


                    </div>


                </div>
                <div class="col-lg-8 col-md-12 col-sm-12" >
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
        function valueToSting(value)
        {
            switch (value)
            {
                case 0:
                    return 'A';
                case 1:
                    return 'B';
                case 2:
                    return 'C';
                case 3:
                    return 'D';
                case 4:
                    return 'E';
                case 5:
                    return 'F';
                case 6:
                    return 'G';
                case 7:
                    return 'H';
                case 8:
                    return 'I';
                case 9:
                    return 'J';
                case 10:
                    return 'K';
                case 11:
                    return 'L';
                case 12:
                    return 'M';
                case 13:
                    return 'N';
                case 14:
                    return 'O';
                case 15:
                    return 'P';
                case 16:
                    return 'Q';
                case 17:
                    return 'R';
                case 18:
                    return 'S';
                case 19:
                    return 'T';
                case 20:
                    return 'U';
                case 21:
                    return 'V';
                case 22:
                    return 'W';
                case 23:
                    return 'X';
                case 24:
                    return 'Y';
                case 25:
                    return 'Z';
                case 26:
                    return 'a';
                case 27:
                    return 'b';
                case 28:
                    return 'c';
                case 29:
                    return 'd';
                case 30:
                    return 'e';
                case 31:
                    return 'f';
                case 32:
                    return 'g';
                case 33:
                    return 'h';
                case 34:
                    return 'i';
                case 35:
                    return 'j';
                case 36:
                    return 'k';
                case 37:
                    return 'l';
                case 38:
                    return 'm';
                case 39:
                    return 'n';
                case 40:
                    return 'o';
                case 41:
                    return 'p';
                case 42:
                    return 'q';
                case 43:
                    return 'r';
                case 44:
                    return 's';
                case 45:
                    return 't';
                case 46:
                    return 'u';
                case 47:
                    return 'v';
                default:
                    return '-';
            }
        }
        function dragStart(e){
            e.dataTransfer.effectAllowed="move";
            e.dataTransfer.setData("text",e.target.getAttribute("id"))
        }
        function dragOver(e){
            return false;
        }

        function mazeDrop(e){
            if(conf){
                let image_Id = e.dataTransfer.getData('text');

                let target_Id = e.currentTarget.id.split('_')



                if(table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]>15 && table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]<32)
                {
                    if(image_Id==='0'){
                       return
                    }else{
                        table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]=16+parseInt(image_Id)
                    }


                }else if (table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]>=32)
                {
                    if(image_Id==='0'||image_Id==='1'||image_Id==='2'||image_Id==='4'||image_Id==='8'){
                        return
                    }else{
                        table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]=32+parseInt(image_Id)
                    }

                }
                else
                {
                    table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]=parseInt(image_Id)
                }
                let duplicate = document.createElement('img')
                duplicate.src = "asset_graphique/"+table_array[parseInt(target_Id[0])][parseInt(target_Id[1])]+".png"
                duplicate.draggable =false
                e.currentTarget.replaceChild(duplicate, e.currentTarget.childNodes[0]);
                let value =""
                for(let i = 0; i <table_array.length;i++)
                {

                    for(let j = 0; j <table_array[i].length;j++)
                    {

                        value+=valueToSting(table_array[i][j])


                    }


                }
                document.querySelector('#labyrinthe_code').value = value




            }


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
            let length = document.querySelector('#setlength').value
            let height = document.querySelector('#setheight').value
            if ((length>length_min-1 && length<=length_max)&& (height>height_min-1 && height<=height_max ))
            {

                let table ="";

                for(let i = 0; i <height;i++)
                {
                    table += "<tr >"
                    let row =[]
                    for(let j = 0; j <length;j++)
                    {
                        table +="<td id='"+i+"_"+j+"' onclick=\"beginAndEnd('"+i+"_"+j+"')\"" +
                            " ondragover='return dragOver(event)' ondrop='mazeDrop(event) ' draggable='false'  class='tuile' ><img src='asset_graphique/0.png'></td>"
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
        .maze{


        }

    </style>
@endsection
