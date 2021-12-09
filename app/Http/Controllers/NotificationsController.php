<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vistas\vistanotifAuto as notif;
use App\Models\vistas\vistanotifAuto;
use App\Models\vistas\vista_notificacion_vinculacion;


class NotificationsController extends Controller
{

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getNotificationsDataVINCULACION(Request $request){



    $notificacion = vista_notificacion_vinculacion::All();

 
        foreach ($notificacion as $not){
                $var = [            
                'icon' => 'fas fa-fw fa-envelope',
                'text' => 'Has recibido una solicitud para su revisión',
                'text2' => 'Materia: '.$not->nombreMateria ,
                'text3' => 'Estudiante: '.$not->estudiante,

                'time' => $not->fecha,
                ];

                $notifications[] = $var;

        }
            // Now, we create the notification dropdown main content.

            $dropdownHtml = '';

            foreach ($notifications as $key => $not) {
                $icon = "<i class='mr-2 {$not['icon']}'></i>";

                $time = "<span class='float-right text-sm text-muted'>
                        {$not['time']}
                        </span>";

                $dropdownHtml .= "<a href='#' class='dropdown-item'>
                                    <span style='font-size: 13px; vertical-align: top;'>  
                                    {$icon}{$not['text']}
                                    </span>
                                    <br>
                                    <span style='font-size: 13px; vertical-align: middle;'>  
                                    {$not['text2']}
                                    </span>
                                    <br>
                                    <span style='font-size: 13px; vertical-align: bottom;'>  
                                    {$not['text3']}{$time}
                                    </span>
                                </a>";

                if ($key < count($notifications) - 1) {
                    $dropdownHtml .= "<div  class='dropdown-divider'></div>";
                }
            }

            return [
                'label'       => count($notifications),
                'label_color' => 'danger',
                'icon_color'  => 'dark',
                'dropdown'    => $dropdownHtml,
            ];
        }


        public function getNotificationsData(Request $request){
            $idusuario = auth()->id();
            $notificacion = notif::Where('id_user',$idusuario)->get();
         
                foreach ($notificacion as $not){
                    if($not->tipo == '3'){
                        $variable= 'Autorizada';
                    }elseif($not->tipo == '2') {
                        $variable= 'Cancelada'; 
                    
                    }
                    
                        $var = [            
                        'icon' => 'fas fa-fw fa-envelope',
                        'text' => 'Tu solicitud ha sido '.$variable,
                        'text2' => 'Materia: '.$not->nombreMateria ,
                        'text3' => 'Estudiante: '.$not->estudiante,
                        'time' => $not->fecha,
                        ];
        
                        $notifications[] = $var;
        
                }
                    // Now, we create the notification dropdown main content.
        
                    $dropdownHtml = '';
        
                    foreach ($notifications as $key => $not) {
                        $icon = "<i class='mr-2 {$not['icon']}'></i>";
        
                        $time = "<span class='float-right text-sm text-muted'>
                                {$not['time']}
                                </span>";
        
                        $dropdownHtml .= "<a href='#' class='dropdown-item'>
                        <span style='font-size: 13px; vertical-align: top;'>  
                        {$icon}{$not['text']}
                        </span>
                        <br>
                        <span style='font-size: 13px; vertical-align: middle;'>  
                        {$not['text2']}
                        </span>
                        <br>
                        <span style='font-size: 13px; vertical-align: bottom;'>  
                        {$not['text3']}{$time}
                        </span>
                                        </a>";
        
                        if ($key < count($notifications) - 1) {
                            $dropdownHtml .= "<div class='dropdown-divider'></div>";
                        }
                    }
        
                    return [
                        'label'       => count($notifications),
                        'label_color' => 'danger',
                        'icon_color'  => 'dark',
                        'dropdown'    => $dropdownHtml,
                    ];
        }
}
