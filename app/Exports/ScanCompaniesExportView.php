<?php


namespace App\Exports;

use DB;
use App\User;
use App\FormSectionField;
use App\Field;
use App\Company;
use App\UserEvent;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Auth;

class ScanCompaniesExportView implements FromView, ShouldAutoSize, WithTitle{

	public function title(): string
    {
        return 'Reporte de Visitantes';
    }

	public $eventId;
	public $companyId;

	public function __construct($eventId, $companyId)
	{
		$this->eventId = $eventId;
		$this->companyId = $companyId;

	}

	public function view(): View {

		set_time_limit(0);

		$roleAuth = User::getUserPermissions(Auth::user()->id)->pluck('UR.role_id');

        $userEventRoleAuth = User::getUserEventPermissions(Auth::user()->id)->where('UE.event_id', $this->eventId)->pluck('UE.user_type_id');

        $eventName = DB::table('events')->where('id', $this->eventId)->pluck('eventName');
            

        $companies = Company::from('companies as c')
                            //->join('user_events as ue', 'ue.company_id', 'c.id')
                            //->join('scan_user_companies as suc', 'suc.scanCompanyDestination', 'c.id')
                            //->select('c.id', 'c.companyName', 'c.companyEmail', 'companyAddress')
                             ->select([\DB::raw('c.id, c.companyName as companyName,
                                                 CASE WHEN c.companyEmail is not null
                                                      THEN c.companyEmail
                                                      ELSE "Correo no registrado"
                                                 END as companyEmail,
                                                 CASE WHEN c.companyAddress is not null
                                                      THEN c.companyAddress
                                                      ELSE ""
                                                 END as companyAddress,
                                                 CASE WHEN c.companyPhone is not null
                                                      THEN c.companyPhone
                                                      ELSE ""
                                                 END as companyPhone,
                                                 CASE WHEN c.companyWebSite is not null
                                                      THEN c.companyWebSite
                                                      ELSE ""
                                                 END as companyWebSite
                                                  ')])
                            ->where('c.event_id', $this->eventId)
                            ->groupBy( 'c.id','c.companyName', 'c.companyEmail', 'companyAddress', 'c.companyPhone', 'companyWebSite')
                            ->orderBy('c.companyName');
            //$companies = $companies->get();

            $tmpl = '<table>
        			<tr><td colspan="5"><h3>Reporte General de '. $eventName[0]   .'</h3></td></tr>
					
				</table>';


			$tmpl .= '<table>
                   <thead style="background: black; color: white;">
                    <tr>
                      <th> # </th>
                      <th> Empresa</th>
                      <th>  </th>
                      <th>  </th>
                      <th>  </th>
                      <th>  </th>';



                       // Filtrar visitante
        if ( $userEventRoleAuth[0] > 3 ){

            $userEventId = UserEvent::where('user_id', Auth::user()->id)
                                      ->where('event_id', $this->eventId)
                                       ->pluck('id');

            $companies = $companies->join('scan_user_companies as suc', 'suc.scanCompanyDestination', 'c.id')
                                   ->where('suc.scanUserSource', $userEventId[0]);


            $companies = $companies->get();

            $color = 0; // 1 gray 0 white
            $companyNo = 1;
            //Recorrer las empresas
            foreach ($companies as $company) {
              $colors = 0; // 1 gray 0 white

                  	 	$tmpl .= '<tr><td>' . $companyNo . '</td>';
                  	 	$tmpl .= '<td>' . $company->companyName . '</td>';
                        $tmpl .= '<td>' . $company->companyEmail . '</td>';
                        $tmpl .= '<td>' . $company->companyPhone . '</td>';
                        $tmpl .= '<td>' . $company->companyAddress . '</td>';
                        $tmpl .= '<td>' . $company->companyWebSite . '</td></tr>';

                     
                
          

              if($colors==0){$colors++;}
              else{$colors=0;}
              $companyNo ++;
            } //end foreach companies


            $tmpl = preg_replace("/&(?!(?:apos|quot|[gl]t|amp);|#)/", '&amp;', $tmpl);
		    return view('backend.admin.exports.visitors', ['tmpl' => $tmpl]);
        }



        if($userEventRoleAuth[0] == 2 || $userEventRoleAuth[0] == 3){

            $userCompanyId = UserEvent::where('user_id', Auth::user()->id)
                                      ->where('event_id', $this->eventId)
                                      ->pluck('company_id');

                                      // dd($userCompanyId);

            $companies = $companies->where('c.id', $userCompanyId[0]);
        } 

        //si es un admin (1), no se filtran las empresas (se obtienen todas)
        
        $companies = $companies->get();

       
        if($companies->count()>0){


            $backgroundCompanies = "#ffa65c";
            $backgroundEmps = "#f2f2f2";
            $color = 0; // 1 gray 0 white
            $companyNo = 1;
            //Recorrer las empresas
            
            if(count($companies)== 0){

            	$tmpl .= '<tr style="background-color:'. $backgroundCompanies .'"><td style="background-color:'. $backgroundCompanies .'">No se encontraron scans.</td>';

            }

            foreach ($companies as $company) {
            	//Empleados de la empresa especificada
            	$companyEmps = $this->getCompanyEmps($company->id, $this->eventId);     
                       
                 

                

                foreach ($companyEmps as $emps) {
                	$scans = $this->getEmpScans($emps->ueId, $this->eventId);
                	if($scans->count()>0){


                		$tmpl .= '<tr style="background-color:'. $backgroundCompanies .'"><td style="background-color:'. $backgroundCompanies .'">' . $companyNo . '</td>';
		          	 	$tmpl .= '<td style="background-color:'. $backgroundCompanies .'">' . $company->companyName . '</td>';
		                $tmpl .= '<td style="background-color:'. $backgroundCompanies .'">' . $company->companyEmail . '</td>';
		                $tmpl .= '<td style="background-color:'. $backgroundCompanies .'">' . $company->companyPhone . '</td>';
		                $tmpl .= '<td style="background-color:'. $backgroundCompanies .'">' . $company->companyAddress . '</td>';
		                $tmpl .= '<td style="background-color:'. $backgroundCompanies .'">' . $company->companyWebSite . '</td></tr>';


	                	$tmpl .= '<tr>';
	                	$tmpl .= '<td></td><td colspan="2" style="background-color:'. $backgroundEmps .'">' . $emps->fullName . ' (' . $scans->count(); if($scans->count() == 0 || $scans->count() >1){ $tmpl .= ' Scans '; } else {$tmpl .= ' Scan'; }  $tmpl .=')' . '</td>' ;
	                	$tmpl .= '</tr>';

	                	$colors = 0; // 1 gray 0 white
	                        foreach ($scans as $scan) {
	                        	$tmpl .= '<tr><td></td>';
	                           
	                            //$report .= '<div class="user-company-scan-user'; if($colors==1){ $report.=' gray-back'; } $report.='">';
	                           
	                                $tmpl .= '<td></td><td>' . $scan->fullName . '</td>';
	                                $tmpl .= '<td>' . $scan->userEmail . '</td>';
	                                $tmpl .= '<td>' . $scan->userPhone . '</td>';

	                            $tmpl .= '</tr>';



	                            if($colors==0){$colors++;}
	                            else{$colors=0;}
	                        }
	                    if($scans->count() > 0){
	                     	$tmpl .= '<tr></tr>';
	                    }
	                    $tmpl .= '<tr></tr>';
	                }
                }


                if($color==0){$color++;}
                else{$color=0;}
            	$companyNo++;
            	
            } //fin foreach empresas
            
            //dd($report);
        } //end if count





            $tmpl = preg_replace("/&(?!(?:apos|quot|[gl]t|amp);|#)/", '&amp;', $tmpl);
		    return view('backend.admin.exports.visitors', ['tmpl' => $tmpl]);

	}


	public function getCompanyEmps($companyId, $eventId){
        $companyEmps = User::from('users as u')
                           ->join('user_events as ue', 'ue.user_id', 'u.id')
                           ->leftJoin('user_event_badges as ueb', 'ueb.user_event_id', 'ue.id')
                           ->join('companies as c', 'c.id', 'ue.company_id')
                           //->join('scan_user_companies as suc', 'suc.scanUserSource', 'ue.id')
                           ->where('ue.company_id', $companyId)
                           ->where('ue.event_id', $eventId)
                           ->select([\DB::raw('ue.id as ueId,
                                                (CASE 
                                                    WHEN CONCAT(ueb.userFirstName, " ", ueb.userLastName, " (", ueb.userEmail,") ") is not null 
                                                    THEN CONCAT(ueb.userFirstName, " ", ueb.userLastName, " (", ueb.userEmail,") ") 
                                                    ELSE CONCAT(u.userFirstName, " ", u.userLastName, " (", u.userEmail,") " ) 
                                                 END) as fullName,  
                                                 (CASE 
                                                    WHEN ueb.userPhoneNumber is not null
                                                    THEN ueb.userPhoneNumber
                                                    ELSE u.userPhoneNumber
                                                 END) as userPhone, c.companyName')])
                           ->orderBy('c.companyName')
                           ->get();

        
        return $companyEmps;
    }


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