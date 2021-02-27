<?php


namespace App\Exports;

use DB;
use App\User;
use App\FormSectionField;
use App\Field;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class VisitorsDinamicExportView implements FromView, ShouldAutoSize, WithTitle{

	public function title(): string
    {
        return 'Reporte de Visitantes';
    }

	public $eventId;

	public function __construct($eventId)
	{
		$this->eventId = $eventId;

	}

	public function view(): View {

		 set_time_limit(0);
    //  $eventId = $request->eventId;
      
      $formData= DB::table('event_forms')->where('event_id',  $this->eventId)->where('form_id', 1581053809)->pluck('form_id');
      $eventName = DB::table('events')->where('id', $this->eventId)->pluck('eventName');

    //  dd($formData);

      $visitorInfo = [];

      
      	 
        $users = DB::table('users as u')
                    ->join('user_events as ue', 'ue.user_id', 'u.id')
                    ->where('ue.user_type_id', 5)
                    ->where('ue.event_id', $this->eventId)
                    ->select('u.id as userId', 'ue.id as user_event_id')
                    ->orderBy('u.userLastName', 'asc')
                    //->take(9300) //9250 9300
                    //->where('u.userEmail', '!=','cristiangarcia|123@gmail.com')
                    ->get();



        $countUsers = count($users);
        


       // $visitorData[] = array();
       
        $tmpl = '<table>
        			<tr><td colspan="2"><h3>Reporte General de '. $eventName[0]   .'</h3></td></tr>
					<tr><td><b> Total Visitantes </b> </td> <td>'. $countUsers .'</td></tr>
				</table>';

        //return view('backend.admin.exports.visitors', ['tmpl' => $tmpl]);

        $tmpl .= '<table>
                   <thead style="background: black; color: white;">
                    <tr>
                      <th> No. </th>
                      <th> Nombre</th>
                      <th> Correo Electrónico </th>
                      <th> Teléfono </th>
                      <th> Perfil Facebook </th>
                      <th> Perfil Twitter </th>
                      <th> Dirección </th>
                      <th> Empresa </th>';
                  $tags = array();

                  

                if(count($formData)>0){

        			$formId = $formData[0];

        			$questionTags =  DB::table('forms as f')
                          ->join('form_sections as fs', 'fs.form_id', 'f.id')
                          ->join('form_section_fields as fsf', 'fsf.form_section_id', 'fs.id')
                          ->join('fields as fi', 'fi.id', 'fsf.field_id')
                          ->join('event_forms as ef', 'ef.form_id', 'f.id')
                          ->where('ef.event_id',  $this->eventId)
                          ->where('fs.section_id', 1)
                          ->where('f.form_type_id', 5)
                          ->select('f.id as form_id', 'fi.fieldText as tag', 'fsf.id as section_field_id')
                          ->get();


                    foreach ($questionTags as $tag) {
                     	$tmpl .= '<th>' . $tag->tag . '</th>';
                     	$tags[] = $tag->tag;
                    }

                    

                }


       

        $tmpl .=  '</tr>
                  </thead>
                  <tbody>';
 

        $userNo = 1;
        $background = '#ffffff';
        foreach ($users as $user) {
            $userId = $user->userId;
            $userEventId = DB::table('user_events')->where('user_id', $user->userId)->pluck('id');

            // Verificar si existe el badge
            $checkBadge =   DB::select( DB::raw("select eb.id from user_event_badges as eb where eb.user_event_id = " . $user->user_event_id . " "));

            //Obtener datos del badge por evento (user_event_badges) , de no tener, traer los datos desde users
            if(count($checkBadge)>0)
            {
	            $userData =   DB::select( DB::raw("select 
	            	                                CASE
	            	                               		WHEN eb.userFirstName is not null
	            	                               		THEN (select CONCAT( (REPLACE(eb.userLastName, '=','')), ' ', (REPLACE(eb.userFirstName, '=','')) ))
	            	                               		ELSE ('Select Concat( (REPLACE(u.userLastName, '=','')), ' ', (REPLACE(u.userFirstName, '=','')) )')
	            	                               	END as fullName,
	            	                               	CASE
	            	                               		WHEN eb.userEmail is not null
	            	                               		THEN (Select REPLACE(eb.userEmail, '=',''))
	            	                               		ELSE (Select REPLACE(u.userEmail, '=',''))
	            	                               	END as userEmail,
	            	                               	CASE
	            	                               		WHEN eb.userPhoneNumber IS NOT NULL
	            	                               		THEN (Select CONCAT(IF(eb.userCountryCode IS NOT NULL,eb.userCountryCode,''), '', eb.userPhoneNumber))
	            	                               		ELSE (Select u.userPhoneNumber)
	            	                               	END as userPhone,
	            	                               	CASE
	            	                               		WHEN eb.userFacebook is not null
	            	                               		THEN (Select eb.userFacebook)
	            	                               		ELSE ''
	            	                               	END as userFacebook,
	            	                               	CASE
	            	                               		WHEN eb.userTwitter is not null
	            	                               		THEN (Select eb.userTwitter)
	            	                               		ELSE ''
	            	                               	END as userTwitter,
	            	                               	CASE
	            	                               		WHEN eb.userAddress is not null
	            	                               		THEN (Select eb.userAddress)
	            	                               		ELSE CASE 
                                                        WHEN u.userAddress is not null 
                                                        THEN (Select u.userAddress)
                                                        ELSE ''
                                                      END
	            	                               	END as userAddress,
	            	                               	CASE
	            	                               		WHEN eb.userCompanyName is not null
	            	                               		THEN (Select eb.userCompanyName)
	            	                               		ELSE ''
	            	                               	END as userCompanyName

	            	                               	FROM user_event_badges as eb
	            	                               	inner join user_events as ue on ue.id = eb.user_event_id
	            	                               	inner join users as u on u.id = ue.user_id
	            	                               	WHERE eb.user_event_id = " . $user->user_event_id . "
                                                
	            						

	            						")); 
	            }
	            else{

	            	 $userData =   DB::select( DB::raw("select Concat(u.userLastName, ', ', u.userFirstName) as fullName,
	            	                                           u.userEmail as userEmail,
	            	                                           u.userPhoneNumber as userPhone,
	            	                                           ' ' as userFacebook,
	            	                                           ' ' as userTwitter,
	            	                                           u.userAddress as userAddress,
	            	                                           ' ' as userCompanyName
	            	                                    from users as u"));

	            }  
	           	
                
             

           /* if($user->user_event_id == 913424947){

            	dd($userData[0]);
            }*/
            //dd($userData[0]);              

            // Obtener los datos de las preguntas
            $userEventForms = DB::table('user_event_forms as uef')
                                ->join('forms as f', 'f.id', 'uef.form_id')
                                ->join('form_sections as fs', 'fs.form_id', 'f.id')
                                ->join('form_section_fields as fsf', 'fsf.form_section_id', 'fs.id')
                                ->where('uef.user_event_id', $user->user_event_id)
                                ->where('fs.section_id', 1)
                                ->where('f.form_type_id', 5)
                                ->where('fs.form_id', 1581053809)
                                ->select('fsf.id as section_field_id')

                                ->get();

                                //->select('f.id as form_id','fi.fieldText as tag','fsf.id as section_field_id')


           // dd($userEventForms);
            $mod = fmod($userNo, 2);
            
            $background = '#ffffff';
            if($mod==0){
            	$background = '#e6e6e6';
            }    


            $tmpl .= '<tr>
            			<td style="background-color:'. $background .'">' . $userNo   . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->fullName . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->userEmail  . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->userPhone  . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->userFacebook  . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->userTwitter  . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->userAddress  . '</td>
                        <td style="background-color:'. $background .'">' . $userData[0]->userCompanyName  . '</td>';    
            
           // printf("<span style='font-weight: 800'>" . $user->userFirstName . "   " . $userId . "</span><br />");

            if(count($formData)>0){
	            $subInfo = array();
              //dd($userEventForms);
	            foreach ($userEventForms as $key) {
	             
	              /* Obtener las respuestas segun form_section_field_id*/
	              $answer =  $this->getAnswerTemplate($key->section_field_id, $userId);
	             // $subInfo[] = $key->tag = $answer;       
	               //if($answer != " " && $answer != 'Redes Sociales')
                 // if($userData[0]->userEmail == "antonyalmeda13@gmail.com")
                 
	             //  printf($key->tag . ": " . $answer . "<br />"); 

	              
	              $tmpl .= '<td style="background-color:'. $background .'">'. $answer .'</td>';
	              
	            }
	        }

            $userNo ++;

          }

          // dd($info);
          $tmpl .= '    </tr>
                        </tbody>
                      </table>';

          

        //  return view('backend.admin.exports.visitors', ['tmpl' => $tmpl]);


        

        $tmpl = preg_replace("/&(?!(?:apos|quot|[gl]t|amp);|#)/", '&amp;', $tmpl);

        //$tmpl = preg_replace('~//\s*?<!\[CDATA\[\s*|\s*//\]\]>~', '', $tmpl);


        

        //dd($tmpl);
		    return view('backend.admin.exports.visitors', ['tmpl' => $tmpl]);
	}


	/* Mostrar respuesta segun tipo de campo de la pregunta*/
    public function getAnswerTemplate($form_section_field_id, $userId){



      /*
      * Obtener id del campo (field_id)
      */

      $fieldId= DB::table('form_section_fields')->where('id', $form_section_field_id)->pluck('field_id');

      /*Obtener el tipo de campo*/
      //$start = microtime(true);
      $fieldType = DB::table('fields as f')
                        ->join('data_type_controls as dc', 'dc.id', 'f.data_type_control_id')
                        ->join('controls as c', 'c.id', 'dc.control_id')
                        ->where('f.id', $fieldId)
                        ->pluck('c.id');

       
       

      
      /*
      * 1 Input
      * 2 Dropdown
      * 3 Radio Button
      * 4 Check Box
      * 5 Text Area
      */


      $answer = DB::table('form_section_field_answers as a')
                    ->join('user_form_section_answers as ua', 'ua.id', 'a.user_form_section_answer_id')        
                    ->where('a.form_section_field_id', $form_section_field_id)
                    ->where('ua.user_id', $userId)
                    ->select('a.answerValue as Value')
                    ->get();

       //$time = microtime(true) - $start;
       //dd($answer, ' ' , $time);
	   //dd($time);
        
        

      switch ($fieldType[0]) {
        // Input
        case "1":

          if((count($answer) > 0) &&  $answer[0]->Value != null){
            return ($answer[0]->Value);
          }
          else{
            return " ";
          }


           
          break;


        // Dropdown
        case "2":

          if((count($answer) > 0) &&  $answer[0]->Value != null && $answer[0]->Value != "0" ){
          $option = DB::table('field_options as fo')
                        ->where('fo.field_id', $fieldId)
                        ->where('fo.optionValue', $answer[0]->Value)
                        ->pluck('fo.optionName')
                        ;
                 return $option[0];
          }
          else{
            return " ";
          }
            


          break;


        case "3":

          break;


        case "4":

          break;

        case "5":

          break;
        
        default:
           return " ";
          break;
      }



     


    }


}
?>