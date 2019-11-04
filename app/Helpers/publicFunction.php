<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class publicFunction
{
	public static function maxCodigo($tabla)
	{
		
         
        $maxArea=DB::select(DB::raw('select * from '.$tabla.' where id = (select max(`id`) from '.$tabla.')'));
        $max;
        
        if($tabla=='equipo')
        {   
                if((count($maxArea))==0)
                {
                    
                    $max=0;
                
                }else
                {
                     foreach($maxArea as $item)
                    {
                        $max=$item->idequipo;
                    }
                    
                }
                
                $max=(int)($max)+1;

                return $max;
        }else
        {
             if((count($maxArea))==0)
                {
                    
                    $max=0;
                
                }else
                {
                     foreach($maxArea as $item)
                    {
                        $max=$item->codigo;
                    }
                    
                }
                
                $max=(int)($max)+1;

                return $max;
        }
               

	}


}