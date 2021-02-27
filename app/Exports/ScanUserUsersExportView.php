<?php


namespace App\Exports;

use DB;
use App\User;
use App\UserEvent;
use App\FormSectionField;
use App\Field;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ScanUserUsersExportView implements FromView, ShouldAutoSize, WithTitle{

	public function title(): string
    {
        return 'Reporte de Visitantes';
    }

	public $eventId;
	public $userId;
	public $type;

	public function __construct($eventId, $userId, $type)
	{
		$this->eventId = $eventId;
		$this->userId = $userId;
		$this->type = $type;

	}

	public function view(): View {

		$userData = User::from('users as u')
                        ->join('user_events as ue', 'ue.user_id', 'u.id')
                        ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                        ->leftJoin('companies as c', 'c.id', 'ue.company_id')
                        ->groupBy('ue.id')
                        ->groupBy('fullName')
                        ->groupBy('userEmail')
                        ->groupBy('userPhone')
                        ->groupBy('userCompany')
                        ->where('ue.event_id', $this->eventId)
                        //->take(12000)
                        ->orderBy('fullName')
                        ->select([\DB::raw('ue.id as ID,
                                            (CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                WHEN u.userPhoneNumber is not null
                                                THEN u.userPhoneNumber
                                                ELSE "N/A"
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')]);


        $userevent = UserEvent::where('user_id',$this->userId)->where('event_id', $this->eventId)->first();
        
       // dd($userData->get()[760]);
    /*    $userData = DB::table('scan_user_users')
            ->join('user_events as uvs','scan_user_users.scanUserSource','uvs.id')
            ->join('user_events as uvd','scan_user_users.scanUserDestination','uvd.id')
            ->join('user_event_badges as ueb','ueb.user_event_id','uvd.id')
            ->join('user_types','uvd.user_type_id','user_types.id')
            ->join('users as u', 'u.id', 'uvs.user_id')
            ->leftJoin('companies as c', 'c.id', 'uvs.company_id')
            ->groupBy('uvs.id')
            ->groupBy('fullName')
            ->groupBy('userEmail')
            ->groupBy('userPhone')
            ->groupBy('userCompany')
            ->where('uvs.event_id', $eventId)
            //->where('scan_user_users.scanUserSource',$userevent->id)
             ->select([\DB::raw('uvs.id as ID,
                                            (CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')])
            ->orderBy('ueb.userFirstName'); */

           
                         

        if($this->userId != 0){
            $userData = $userData->where('u.id', $this->userId);

            //$userData = $userData->where('scan_user_users.scanUserSource',$userevent->id);
        }



        $userData = $userData->get();

        //dd($userData[0]);
                        

        $color = 0;
        $report = '';
        $userNo = 1;
        foreach ($userData /*->chunk(100)*/ as $user) {

            //foreach ($chunk as $) {
            
           

            $scans = $this->getEmpScans($user->ID, $this->eventId);
            
                //$report .= '<div class="scan-container'; if($color==1){ $report.=' gray-back'; } $report.='" >';
                    
                    $report .= '<table><tr><td  style="background-color: #ee7f22; color: #ffffff; border-top: 1px solid #000000; padding-left: 10px;" align="right" class="company-name">'. $userNo . '</td><td style="background-color: #ee7f22; color: #ffffff; border-top: 1px solid #000000; padding-left: 10px;" align="right" class="company-name">' . $user->fullName . ' ('. count($scans) .')</td></tr></table>';
                    $report .= '<div class="scan-detail">';

                        //$report .= '<div class="scan-detail-title">';
                          //  $report .= '<span>SCANS REALIZADOS ('. count($scans) .')</span>';
                        //$report .= '</div>';
                    $report .= '</div>';
                    
                    $report .= '<div class="scan-detail-body">';

                        //ususarios
                        $colors = 0; // 1 gray 0 white
                        foreach ($scans as $scan) {
                            //recorrer los escans de los empleados

                            
                            $report .= '<div class="user-company-scan-user-container">';
                           
                                
                                    $report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
                                   
                                        $report .= '<table><tr><td></td><td class="user-scaned-data"><h5>' . $scan->fullName . '</h5></td></tr>';
                                        $report .= '<tr><td></td><td class="user-scaned-data"><h5>' . $scan->userEmail . '</td></tr>';
                                        $report .= '<tr><td></td><td class="user-scaned-data" align="left"><h4>' . $scan->userPhone . '</h4></td></tr></table>';

                                    $report .= '</div>';

                                    if($colors==0){$colors++;}
                                    else{$colors=0;}
                                
                            $report .= '</div>'; //fin user-company-scan-user


                        } //fin foreach scans

                    $report .= '</div>'; //fin scan-detail-body

               // $report .= '</div>'; // fin scan-container
            if($color==0){$color++;}
            else{$color=0;}


          //} //end chunk foreach
            $userNo++;
        } // end foreach user data



        $report =  preg_replace("/&(?!(?:apos|quot|[gl]t|amp);|#)/", '&amp;', $report);

        return view('backend.admin.scans.users-companies-report', ['data'=> $report, 'type' => $this->type]);

	}


	 //obtener scans de usuarios de empresas a otros usuarios

    public function getEmpScans($empId, $eventId){



        $scans = User::from('users as u')
                       ->join('user_events as ue', 'ue.user_id', 'u.id')
                       ->join('scan_user_users as suu', 'suu.scanUserDestination', 'ue.id')    
                       ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                       ->leftjoin('companies as c', 'c.id', 'ue.company_id')
                       ->groupBy('fullName')
                       ->groupBy('userEmail')
                       ->groupBy('userPhone')
                       ->groupBy('userCompany')
                       ->where('suu.scanUserSource', $empId)
                       ->where('ue.event_id', $eventId)
                       ->select([\DB::raw('(CASE 
                                                WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) is not null 
                                                THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName) 
                                                ELSE CONCAT(u.userFirstName, " ", u.userLastName ) 
                                             END) as fullName,  
                                             (CASE 
                                                WHEN ueb.userEmail is not null
                                                THEN ueb.userEmail
                                                ELSE u.userEmail
                                             END) as userEmail, 
                                             (CASE 
                                                WHEN ueb.userPhoneNumber is not null
                                                THEN ueb.userPhoneNumber
                                                ELSE u.userPhoneNumber
                                             END) as userPhone, 
                                              (CASE 
                                                WHEN c.companyName is not null
                                                THEN c.companyName
                                                ELSE "Sin empresa"
                                             END) as userCompany')])
                       ->orderBy('c.companyName')
                       ->groupBy('c.companyName')
                       
                       ->get();


        

        return $scans;
    }



}

?>