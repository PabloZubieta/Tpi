<?php
/**
 * @file resolution.blade.php
 * @brief file description
 * @author Created by Pablo-Fernando.ZUBIE
 * @version 09.05.2023
 */
$title = "création";
$path="";
if(isset($back))
{
   $path= $back;
}

?>
@extends('layout')

@section('content')
    <script>
        function alter_Table(direction){
            for(let i=0;i<table_array.length;i++){
                for (let j=0;j<table_array.length;j++){
                    if (table_array[i][j]>15 && table_array[i][j]<32){

                        table_array[i][j]-=16
                        switch (direction){
                            case 1:
                                table_array[i-1][j]+=16
                                return
                            case 2:
                                table_array[i][j+1]+=16
                                return
                            case 4:
                                table_array[i+1][j]+=16
                                return
                            case 8:
                                table_array[i][j-1]+=16

                                return
                        }
                    }

                }
            }
        }
        function get_Me_Out(number) {
        alter_Table(number)




        }

        let table_array  =  @php echo json_encode($maze) @endphp





    </script>
    <div >
        <div class="container col-lg-12 col-md-12 col-sm-12 " >
            <div class="row" >
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <h4 class="d-flex justify-content-center">Le Labyrinthe</h4>
                    <table class="d-flex justify-content-center" id="maze">
                        @for($i= 0; $i<sizeof($maze); $i++)
                            <tr>
                                @for($j= 0; $j<sizeof($maze[0]); $j++)
                                    <td><img id="{{$i}}_{{$j}}" src="{{$path}}asset_graphique/{{$maze[$i][$j]}}.png"></td>
                                @endfor
                            </tr>
                        @endfor
                    </table>




                </div>
                <div class="col-lg-4 col-md-12 col-sm-12" >
                    <div>
                        <h4 class="d-flex justify-content-center">Les Explications</h4>
                        <p>
                            Vous voici dans l'interface de résolution des labyrinthes. Elle vous permet de résoudre vos propres labyrinthe ou des labyrinthes générer aléatoirement.
                            Vous avec préalablement choisis la taille du labyrinthe.
                            Les flèches directionnelles ci-dessous vous permet de déplacer dans le labyrinthe (Spoiler je n’ai pas eu temps d’implémenter cette fonctionnalité)
                            Arrivez-vous à vous enfuir de ce labyrinthe.

                        </p>
                    </div>
                    <div >
                        <div class="row">
                            <div class="col-4">
                            </div>
                            <div class="col-4" onclick="get_Me_Out(1)">
                                <p>&uarr;</p>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4" onclick="get_Me_Out(8)">
                                <p >&larr;</p>
                            </div>
                            <div class="col-4">
                            </div>
                            <div class="col-4" onclick="get_Me_Out(2)">
                                <p>&rarr;</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                            </div>
                            <div class="col-4" onclick="get_Me_Out(4)">
                                <p>&darr;</p>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </div>



                </div>


            </div>


        </div>

    </div>

@endsection
