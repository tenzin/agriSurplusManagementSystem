<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use DB;
use App\Demand;
use App\EXSurplus;
use App\Dzongkhag;
use App\SurplusView;
use App\DemandView;

class ReportController extends Controller
{
    public $details;
    public function __construct() {
        
       // $this->request = $request;
        $this->middleware('auth');
    }
    //
    public function report()
    {
        $ptypes = ProductType::all();
        $details = Demand::all();
        $dzongkhags = Dzongkhag::all();

        return view("reports.report",compact("ptypes","details","dzongkhags"));
    }

    //search with parameters.
    public function search(Request $request)
    {
       $type = $request->report_type;
       

        if($request->report_type == "Surplus")
        {
            //filtering of details.
            if(!empty($request->product_type)) //product type = selected.
            {
                if(!empty($request->product)) //product = selected.
                {
                    if(!empty($request->dzongkhag)) //dzongkhag = selected
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                            //when t=1,p=1,d=1,g=1
                           $details = SurplusView::where('type_id','=',$request->product_type)
                                                ->where('product_id','=',$request->product)
                                                ->where('dzongkhag_id','=',$request->dzongkhag)
                                                ->where('gewog_id','=',$request->gewog)
                                                ->get();                          
                        }
                        else
                        {
                           //when t=1,p=1,d=1,g=0
                           $details = SurplusView::where('type_id','=',$request->product_type)
                           ->where('product_id','=',$request->product)
                           ->where('dzongkhag_id','=',$request->dzongkhag)
                           ->get();
                        }

                    }
                    else //dzongkhag = all.
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                           //when t=1,p=1,d=0,g=1
                           $details = SurplusView::where('type_id','=',$request->product_type)
                                                ->where('product_id','=',$request->product)                                               
                                                ->where('gewog_id','=',$request->gewog)
                                                ->get();  
                        }
                        else
                        {
                          //when t=1,p=1,d=0,g=0
                          $details = SurplusView::where('type_id','=',$request->product_type)
                          ->where('product_id','=',$request->product)                                                   
                          ->get();  
                        }

                    }
                } 
                else // type = selected, product = all.
                {
                    if(!empty($request->dzongkhag)) //dzongkhag = selected
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                          //when t=1,p=0,d=1,g=1
                          $details = SurplusView::where('type_id','=',$request->product_type)                    
                          ->where('dzongkhag_id','=',$request->dzongkhag)
                          ->where('gewog_id','=',$request->gewog)
                          ->get();  
                        }
                        else
                        {
                         //when t=1,p=0,d=1,g=0
                         $details = SurplusView::where('type_id','=',$request->product_type)                        
                         ->where('dzongkhag_id','=',$request->dzongkhag)                        
                         ->get();  
                        }
                    }
                    else
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                         //when t=1,p=0,d=0,g=1
                         $details = SurplusView::where('type_id','=',$request->product_type)                                         
                         ->where('gewog_id','=',$request->gewog)
                         ->get();  
                        }
                        else
                        {
                         //when t=1,p=0,d=0,g=0
                         $details = SurplusView::where('type_id','=',$request->product_type)                                                                     
                         ->get();  
                        }

                    }
                }
              //  $details = EXSurplus::where('productType_id','=',$request->product_type)->get();
            }
            else //product type = all.
            {
                if(!empty($request->product)) //product = selected.
                {
                    if(!empty($request->dzongkhag)) //dzongkhag = selected
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                           //when t=0,p=1,d=1,g=1
                           $details = SurplusView::where('product_id','=',$request->product)
                                                ->where('dzongkhag_id','=',$request->dzongkhag)
                                                ->where('gewog_id','=',$request->gewog)
                                                ->get(); 
                        }
                        else 
                        {
                            //when t=0,p=1,d=1,g=0
                           $details = SurplusView::where('product_id','=',$request->product)
                           ->where('dzongkhag_id','=',$request->dzongkhag)                         
                           ->get(); 
                        }

                    }
                    else  //type=all, dzongkhag=all
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                            //when t=0,p=1,d=0,g=1
                           $details = SurplusView::where('product_id','=',$request->product)                          
                           ->where('gewog_id','=',$request->gewog)
                           ->get(); 
                        }
                        else
                        {
                             //when t=0,p=1,d=0,g=0
                           $details = SurplusView::where('product_id','=',$request->product)                                                    
                           ->get(); 
                        }

                    }

                } 
                else //type=all,product=all.
                {
                    if(!empty($request->dzongkhag)) //dzongkhag = selected
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                             //when t=0,p=0,d=1,g=1
                           $details = SurplusView::where('dzongkhag_id','=',$request->dzongkhag)                          
                           ->where('gewog_id','=',$request->gewog)
                           ->get(); 
                        }
                        else
                        {
                           //when t=0,p=0,d=1,g=0
                           $details = SurplusView::where('dzongkhag_id','=',$request->dzongkhag)                                                     
                           ->get(); 
                        }

                    }
                    else //type=all, product=all, dzongkhag=all.
                    {
                        if(!empty($request->gewog)) //gewog = selected.
                        {
                             //when t=0,p=0,d=0,g=1
                           $details = SurplusView::where('gewog_id','=',$request->gewog)
                           ->get(); 
                        }
                        else
                        {
                           //when t=0,p=0,d=0,g=0
                           $details = SurplusView::all(); 
                        }

                    }
                }
                
            }
           
        }
        else
        { //in demand.
           //filtering of details.
           if(!empty($request->product_type)) //product type = selected.
           {
               if(!empty($request->product)) //product = selected.
               {
                   if(!empty($request->dzongkhag)) //dzongkhag = selected
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                           //when t=1,p=1,d=1,g=1
                          $details = DemandView::where('type_id','=',$request->product_type)
                                               ->where('product_id','=',$request->product)
                                               ->where('dzongkhag_id','=',$request->dzongkhag)
                                               ->where('gewog_id','=',$request->gewog)
                                               ->get();                          
                       }
                       else
                       {
                          //when t=1,p=1,d=1,g=0
                          $details = DemandView::where('type_id','=',$request->product_type)
                          ->where('product_id','=',$request->product)
                          ->where('dzongkhag_id','=',$request->dzongkhag)
                          ->get();
                       }

                   }
                   else //dzongkhag = all.
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                          //when t=1,p=1,d=0,g=1
                          $details = DemandView::where('type_id','=',$request->product_type)
                                               ->where('product_id','=',$request->product)                                               
                                               ->where('gewog_id','=',$request->gewog)
                                               ->get();  
                       }
                       else
                       {
                         //when t=1,p=1,d=0,g=0
                         $details = DemandView::where('type_id','=',$request->product_type)
                         ->where('product_id','=',$request->product)                                                   
                         ->get();  
                       }

                   }
               } 
               else // type = selected, product = all.
               {
                   if(!empty($request->dzongkhag)) //dzongkhag = selected
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                         //when t=1,p=0,d=1,g=1
                         $details = DemandView::where('type_id','=',$request->product_type)                    
                         ->where('dzongkhag_id','=',$request->dzongkhag)
                         ->where('gewog_id','=',$request->gewog)
                         ->get();  
                       }
                       else
                       {
                        //when t=1,p=0,d=1,g=0
                        $details = DemandView::where('type_id','=',$request->product_type)                        
                        ->where('dzongkhag_id','=',$request->dzongkhag)                        
                        ->get();  
                       }
                   }
                   else
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                        //when t=1,p=0,d=0,g=1
                        $details = DemandView::where('type_id','=',$request->product_type)                                         
                        ->where('gewog_id','=',$request->gewog)
                        ->get();  
                       }
                       else
                       {
                        //when t=1,p=0,d=0,g=0
                        $details = DemandView::where('type_id','=',$request->product_type)                                                                     
                        ->get();  
                       }

                   }
               }
             //  $details = EXSurplus::where('productType_id','=',$request->product_type)->get();
           }
           else //product type = all.
           {
               if(!empty($request->product)) //product = selected.
               {
                   if(!empty($request->dzongkhag)) //dzongkhag = selected
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                          //when t=0,p=1,d=1,g=1
                          $details = DemandView::where('product_id','=',$request->product)
                                               ->where('dzongkhag_id','=',$request->dzongkhag)
                                               ->where('gewog_id','=',$request->gewog)
                                               ->get(); 
                       }
                       else 
                       {
                           //when t=0,p=1,d=1,g=0
                          $details = DemandView::where('product_id','=',$request->product)
                          ->where('dzongkhag_id','=',$request->dzongkhag)                         
                          ->get(); 
                       }

                   }
                   else  //type=all, dzongkhag=all
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                           //when t=0,p=1,d=0,g=1
                          $details = DemandView::where('product_id','=',$request->product)                          
                          ->where('gewog_id','=',$request->gewog)
                          ->get(); 
                       }
                       else
                       {
                            //when t=0,p=1,d=0,g=0
                          $details = DemandView::where('product_id','=',$request->product)                                                    
                          ->get(); 
                       }

                   }

               } 
               else //type=all,product=all.
               {
                   if(!empty($request->dzongkhag)) //dzongkhag = selected
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                            //when t=0,p=0,d=1,g=1
                          $details = DemandView::where('dzongkhag_id','=',$request->dzongkhag)                          
                          ->where('gewog_id','=',$request->gewog)
                          ->get(); 
                       }
                       else
                       {
                          //when t=0,p=0,d=1,g=0
                          $details = DemandView::where('dzongkhag_id','=',$request->dzongkhag)                                                     
                          ->get(); 
                       }

                   }
                   else //type=all, product=all, dzongkhag=all.
                   {
                       if(!empty($request->gewog)) //gewog = selected.
                       {
                            //when t=0,p=0,d=0,g=1
                          $details = DemandView::where('gewog_id','=',$request->gewog)
                          ->get(); 
                       }
                       else
                       {
                          //when t=0,p=0,d=0,g=0
                          $details = DemandView::all(); 
                       }

                   }
               }
               
           }
        }

        return view("reports.reportdetails",compact("details","type"));

    }
}
