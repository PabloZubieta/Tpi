<?php

namespace App\Http\Controllers;

use App\Models\Labyrinthe;
use App\Models\Users_does_labyrinthe;
use Illuminate\Http\Request;

class LabyrintheController extends Controller
{
    //Fonction de transformation d'une string en valeur de tuile
    private function stringtovalue(string $letter)
    {
        switch ($letter)
        {
            case 'A':
                return 0;
            case 'B':
                return 1;
            case 'C':
                return 2;
            case 'D':
                return 3;
            case 'E':
                return 4;
            case 'F':
                return 5;
            case 'G':
                return 6;
            case 'H':
                return 7;
            case 'I':
                return 8;
            case 'J':
                return 9;
            case 'K':
                return 10;
            case 'L':
                return 11;
            case 'M':
                return 12;
            case 'N':
                return 13;
            case 'O':
                return 14;
            case 'P':
                return 15;
            case 'Q':
                return 16;
            case 'R':
                return 17;
            case 'S':
                return 18;
            case 'T':
                return 19;
            case 'U':
                return 20;
            case 'V':
                return 21;
            case 'W':
                return 22;
            case 'X':
                return 23;
            case 'Y':
                return 24;
            case 'Z':
                return 25;
            case 'a':
                return 26;
            case 'b':
                return 27;
            case 'c':
                return 28;
            case 'd':
                return 29;
            case 'e':
                return 30;
            case 'f':
                return 31;
            case 'g':
                return 32;
            case 'h':
                return 33;
            case 'i':
                return 34;
            case 'j':
                return 35;
            case 'k':
                return 36;
            case 'l':
                return 37;
            case 'm':
                return 38;
            case 'n':
                return 39;
            case 'o':
                return 40;
            case 'p':
                return 41;
            case 'q':
                return 42;
            case 'r':
                return 43;
            case 's':
                return 44;
            case 't':
                return 45;
            case 'u':
                return 46;
            case 'v':
                return 47;
            default:
                return -1;
        }





    }
    //Fonction de transformation en valeur de tuile en string pour être inserer dans la base de donnée
    private function valuetostring(string $value)
    {
        switch ($value)
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

    public function interface()
    {
        return view('mazes.interface');
    }
    //
    //fonction d'affichage de la View création
    public function editor()
    {
        return view('mazes.creation');
    }
    //fonction d'affichage de la View resolution avec un labyrinthe aléatoire

    /**
     * @throws \Exception
     */
    public function escape(Request $request)
    {

        $formFields = $request->validate([
            // verifie si l'utilisateur existe déjà
            'height'=>'lte:10|gte:4',
            'length'=>'lte:10|gte:4'
        ]);


        $maze_value = [];
        $maze_boolean = [];
        $maze_array = [];
        $value =0;
        for ($i = 0; $i < $formFields['height']; $i++) {
            for ($j = 0; $j < $formFields['length']; $j++) {
                $maze_value[$i][$j] = $value;
                $maze_boolean[$i][$j] =false;
                $maze_array[$i][$j] =0;
                $value++;


            }

        }

        $random_start= random_int(0,$value-1);
        $maze_boolean[intdiv($random_start, $formFields['height'])][$random_start%$formFields['length']] =true;
        $complete = false;

        while (!$complete)
           //for($k = 0; $k < 40; $k++)
        {
            $random_try= random_int(0,$value-1);
            $posi1=intdiv($random_try, $formFields['length']);
            $posi2=$random_try%$formFields['length'];
            $random_position= random_int(1,4);
            switch ($random_position)
            {
                case 1:
                    if((!($maze_array[$posi1][$posi2]&1))&&($posi1!=0))
                    {
                        if($maze_value[$posi1][$posi2]!=$maze_value[$posi1-1][$posi2]){
                            $maze_array[$posi1][$posi2]+=1;
                            $maze_array[$posi1-1][$posi2]+=4;
                            $val_remplace =$maze_value[$posi1-1][$posi2];
                            $maze_boolean[$posi1][$posi2]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1-1][$posi2];
                            $maze_boolean[$posi1-1][$posi2]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1-1][$posi2];
                            for ($i = 0; $i < $formFields['height']; $i++) {
                                for ($j = 0; $j < $formFields['length']; $j++) {
                                    if($maze_value[$i][$j]==$val_remplace)
                                    {
                                        $maze_value[$i][$j]=$maze_value[$posi1][$posi2];
                                        $maze_boolean[$i][$j]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$i][$j];
                                    }

                                }
                            }
                        }

                    }
                    break;
                case 2:
                    if((!($maze_array[$posi1][$posi2]&2))&&($posi2!=$formFields['length']-1))
                    {
                        if($maze_value[$posi1][$posi2]!=$maze_value[$posi1][$posi2+1]){
                            $maze_array[$posi1][$posi2]+=2;
                            $maze_array[$posi1][$posi2+1]+=8;
                            $val_remplace =$maze_value[$posi1][$posi2+1];
                            $maze_boolean[$posi1][$posi2]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1][$posi2+1];
                            $maze_boolean[$posi1][$posi2+1]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1][$posi2+1];
                            for ($i = 0; $i < $formFields['height']; $i++) {
                                for ($j = 0; $j < $formFields['length']; $j++) {
                                    if($maze_value[$i][$j]==$val_remplace)
                                    {
                                        $maze_value[$i][$j]=$maze_value[$posi1][$posi2];
                                        $maze_boolean[$i][$j]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$i][$j];
                                    }

                                }
                            }
                        }

                    }
                    break;
                case 3:
                    if((!($maze_array[$posi1][$posi2]&4))&&($posi1!=$formFields['height']-1))
                    {
                        if($maze_value[$posi1][$posi2]!=$maze_value[$posi1+1][$posi2]){
                            $maze_array[$posi1][$posi2]+=4;
                            $maze_array[$posi1+1][$posi2]+=1;
                            $val_remplace =$maze_value[$posi1+1][$posi2];
                            $maze_boolean[$posi1][$posi2]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1+1][$posi2];
                            $maze_boolean[$posi1+1][$posi2]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1+1][$posi2];
                            for ($i = 0; $i < $formFields['height']; $i++) {
                                for ($j = 0; $j < $formFields['length']; $j++) {
                                    if($maze_value[$i][$j]==$val_remplace)
                                    {
                                        $maze_value[$i][$j]=$maze_value[$posi1][$posi2];
                                        $maze_boolean[$i][$j]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$i][$j];
                                    }

                                }
                            }
                        }

                    }

                    break;
                case 4:
                    if((!($maze_array[$posi1][$posi2]&8))&&($posi2!=0))
                    {
                        if($maze_value[$posi1][$posi2]!=$maze_value[$posi1][$posi2-1]){
                            $maze_array[$posi1][$posi2]+=8;
                            $maze_array[$posi1][$posi2-1]+=2;
                            $val_remplace =$maze_value[$posi1][$posi2-1];
                            $maze_boolean[$posi1][$posi2]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1][$posi2-1];
                            $maze_boolean[$posi1][$posi2-1]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$posi1][$posi2-1];
                            for ($i = 0; $i < $formFields['height']; $i++) {
                                for ($j = 0; $j < $formFields['length']; $j++) {
                                    if($maze_value[$i][$j]==$val_remplace)
                                    {
                                        $maze_value[$i][$j]=$maze_value[$posi1][$posi2];
                                        $maze_boolean[$i][$j]=$maze_boolean[$posi1][$posi2]||$maze_boolean[$i][$j];
                                    }

                                }
                            }
                        }

                    }
                    break;
            }
            $val_remplace2=$maze_value[0][0];

            $complete=true;
            for ($i = 0; $i < $formFields['height']; $i++) {
                for ($j = 0; $j < $formFields['length']; $j++) {
                    if($maze_value[$i][$j]!=$val_remplace2)
                    {
                        $complete=false;
                    }

                }
            }





        }

        $exit=2*$formFields['height']+2*$formFields['length'];
        $random_end= random_int(1,$exit);
        $end_position=[];
        if($random_end<$formFields['length']+1)
        {
            $maze_array[0][$random_end-1]+=33;
            $end_position=[0,$random_end-1];
        }
        elseif ($random_end>$formFields['length']&&($random_end<$formFields['length']+$formFields['height']+1))
        {
            $maze_array[$random_end-$formFields['length']-1][$formFields['length']-1]+=34;
            $end_position=[$random_end-$formFields['length']-1,$formFields['length']-1];
        }
        elseif (($random_end>$formFields['length']+$formFields['height'])&&($random_end<2*$formFields['length']+$formFields['height']+1))
        {
            $maze_array[$formFields['height']-1][$random_end-$formFields['length']-$formFields['height']-1]+=36;
            $end_position=[$formFields['height']-1,$random_end-$formFields['length']-$formFields['height']-1];
        }
        elseif ($random_end>2*$formFields['length']+$formFields['height'])
        {
            $maze_array[$random_end-2*$formFields['length']-$formFields['height']-1][0]+=40;
            $end_position=[$random_end-2*$formFields['length']-$formFields['height']-1,0];
        }
        $posi1=0;
        $posi2=0;
        do{
            $random_try= random_int(0,$value-1);
            $posi1=intdiv($random_try, $formFields['length']);
            $posi2=$random_try%$formFields['length'];
        }while($end_position==[$posi1,$posi2]);
        $maze_array[$posi1][$posi2] +=16;
        $formFields['labyrinthe_code']="";
        for ($i = 0; $i < $formFields['height']; $i++) {
            for ($j = 0; $j < $formFields['length']; $j++) {
                $formFields['labyrinthe_code'] .= $this->valuetostring($maze_array[$i][$j]);

            }
        }
        $lab=Labyrinthe::firstWhere('labyrinthe_code',$formFields['labyrinthe_code']);
        $id=1;
        if (!$lab){
            $formFields['created_at'] = date('Y-m-d H:i:s',strtotime('now'));

            $id =Labyrinthe::insertGetId($formFields);
        }
        else
        {
         $id=$lab->id  ;
        }
        Users_does_labyrinthe::create(['users_id'=>auth()->user()->id,'labyrinthes_id'=>$id]);







        return view('mazes.resolution',['maze'=>$maze_array]);





    }
    //fonction d'affichage de la View resolution
    public function escapeThis($id)
    {

        $lab =Labyrinthe::Where('id','=',$id)->get();

        $maze_array=[];
        for ($i = 0; $i < $lab[0]->height; $i++) {
            for ($j = 0; $j < $lab[0]->length; $j++) {
                $maze_array[$i][$j] = $this->stringtovalue($lab[0]->labyrinthe_code[($i * $lab[0]->length) + $j]);

            }

        }

        $back="../";


        return view('mazes.resolution',['maze'=>$maze_array,'back'=>$back]);
    }


    //fonction d'insertion du labrinthe
    public function create(Request $request)
    {
        $formFields = $request->validate([
            // verifie si l'utilisateur existe déjà
            'labyrinthe_code' => 'required',
            'length' => 'required',
            'height' => 'required'

        ]);

        $formFields['users_id'] = auth()->user()->id;


        //$maze_code = $formFields['labyrinthe_code'].substr();
        $orginal_maze =[];
        $maze_array = [];
        $maze_path = [];

        for ($i = 0; $i < $formFields['height']; $i++) {
            for ($j = 0; $j < $formFields['length']; $j++) {
                $maze_array[$i][$j] = $this->stringtovalue($formFields['labyrinthe_code'][($i * $formFields['height']) + $j]);
                $maze_path [$i][$j] = 0;
                $orginal_maze[$i][$j] = $this->stringtovalue($formFields['labyrinthe_code'][($i * $formFields['height']) + $j]);
                if ($maze_array[$i][$j] > 15 && $maze_array[$i][$j] < 32) {
                    $maze_array['start'] = [$i, $j];
                } else if ($maze_array[$i][$j] >= 32) {
                    $maze_array['finish'] = [$i, $j];
                }
            }

        }
        $last_position= [$maze_array['start']];
        $maze_position =$maze_array['start'];
        //

        $solve= 2;
        $i=0;
        /*if(($maze_path[$maze_position[0]][$maze_position[1]]>0)||(($maze_array[$maze_position[0]][$maze_position[1]]>16)&&($maze_array[$maze_position[0]][$maze_position[1]]<31)))
                {
                    $maze_array[$maze_position[0]][$maze_position[1]]-=4;
                }
                if(($maze_path[$maze_position[0]][$maze_position[1]]>0)||(($maze_array[$maze_position[0]][$maze_position[1]]>16)&&($maze_array[$maze_position[0]][$maze_position[1]]<31)))
                {
                    $maze_array[$maze_position[0]][$maze_position[1]]-=8;
                }
                if(($maze_path[$maze_position[0]][$maze_position[1]]>0)||(($maze_array[$maze_position[0]][$maze_position[1]]>16)&&($maze_array[$maze_position[0]][$maze_position[1]]<31)))
                {
                    $maze_array[$maze_position[0]][$maze_position[1]]-=1;
                }
                if(($maze_path[$maze_position[0]][$maze_position[1]]>0)||(($maze_array[$maze_position[0]][$maze_position[1]]>16)&&($maze_array[$maze_position[0]][$maze_position[1]]<31)))
                {
                    $maze_array[$maze_position[0]][$maze_position[1]]-=2;
                }

                */
        while ($solve==2)
        //for ($i = 0; $i < 3; $i++)
        {
            if($maze_array[$maze_position[0]][$maze_position[1]]&1)
            {

                $maze_array[$maze_position[0]][$maze_position[1]]-=1;
                if(($maze_position[0]==0)||($maze_path[$maze_position[0]][$maze_position[1]]&1))
                {

                }
                else
                {
                    if ($maze_array[$maze_position[0]-1][$maze_position[1]]&4)
                    {
                        if($maze_array[$maze_position[0]][$maze_position[1]]>$maze_path[$maze_position[0]][$maze_position[1]])
                        {
                            array_push( $last_position,$maze_position);

                        }
                        $maze_position[0]--;
                        $maze_path[$maze_position[0]][$maze_position[1]]+=4;
                        if($maze_array[$maze_position[0]][$maze_position[1]]>31){
                            $solve= 1;

                        }
                    }
                }

            }
            elseif ($maze_array[$maze_position[0]][$maze_position[1]]&2)
            {

                $maze_array[$maze_position[0]][$maze_position[1]]-=2;
                if(($maze_position[1]==$formFields['length']-1)||($maze_path[$maze_position[0]][$maze_position[1]]&2))
                {

                }
                else
                {
                    if($maze_array[$maze_position[0]][$maze_position[1]+1]&8)
                    {
                        if($maze_array[$maze_position[0]][$maze_position[1]]>$maze_path[$maze_position[0]][$maze_position[1]])
                        {
                            array_push( $last_position,$maze_position);
                        }
                        $maze_position[1]++;
                        $maze_path[$maze_position[0]][$maze_position[1]]+=8;
                        if($maze_array[$maze_position[0]][$maze_position[1]]>31){
                            $solve= 1;

                        }
                    }
                }
            }
            elseif ($maze_array[$maze_position[0]][$maze_position[1]]&4)
            {

                $maze_array[$maze_position[0]][$maze_position[1]]-=4;
                if (($maze_position[0]==$formFields['height']-1)||($maze_path[$maze_position[0]][$maze_position[1]]&4))
                {


                }
                else
                {
                    if($maze_array[$maze_position[0]+1][$maze_position[1]]&1)
                    {
                        if($maze_array[$maze_position[0]][$maze_position[1]]>$maze_path[$maze_position[0]][$maze_position[1]])
                        {
                            array_push( $last_position,$maze_position);
                        }
                        $maze_position[0]++;
                        $maze_path[$maze_position[0]][$maze_position[1]]+=1;
                        if($maze_array[$maze_position[0]][$maze_position[1]]>31){
                            $solve= 1;

                        }
                    }
                }
            }
            elseif ((($maze_array[$maze_position[0]][$maze_position[1]]&8)))
            {


                $maze_array[$maze_position[0]][$maze_position[1]]-=8;
                if (($maze_position[1]==0)||($maze_path[$maze_position[0]][$maze_position[1]]&8))
                {

                }
                else
                {
                    if(($maze_array[$maze_position[0]][$maze_position[1]-1]&2))
                    {
                        if($maze_array[$maze_position[0]][$maze_position[1]]>$maze_path[$maze_position[0]][$maze_position[1]])
                        {
                            array_push( $last_position,$maze_position);

                        }
                        $maze_position[1]--;
                        $maze_path[$maze_position[0]][$maze_position[1]]+=2;

                        if($maze_array[$maze_position[0]][$maze_position[1]]>31){
                            $solve= 1;

                        }
                    }
                }
            }
            else{



                $maze_position=$last_position[sizeof($last_position)-1];
                array_pop($last_position);
                if($maze_array[$maze_position[0]][$maze_position[1]]==16){
                    $solve= 4;
                }

            }
            $i++;
            if ($i==120){
                $solve= 0;
            }
        }

       if($solve==1) {
           $lab=Labyrinthe::firstWhere('labyrinthe_code',$formFields['labyrinthe_code']);
           $id=1;
           if (!$lab){
               $formFields['created_at'] = date('Y-m-d H:i:s',strtotime('now'));
              $id =Labyrinthe::insertGetId($formFields);
           }
           else
           {
               $id=$lab->id  ;
           }
           Users_does_labyrinthe::create(['users_id'=>auth()->user()->id,'labyrinthes_id'=>$id]);






           return view('mazes.resolution',['maze'=>$orginal_maze]);

       }
       else {

           return back()->with('message', $orginal_maze);
       }


        return redirect('/');



    }

}
