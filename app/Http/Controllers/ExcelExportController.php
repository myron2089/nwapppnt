<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Event;
use App\EventType;
use App\User;
use Auth;
use App\Http\Controllers\FieldTemplateController;
use App\Field;
use App\FieldOption;
use App\FormSectionField;
use App\UserEventForm;
use App\UserEvent;
use App\FormSection;
use App\EventSession;
use App\FormSectionFieldAnswer;
use App\UserFormSectionAnswer;
use App\UserEventSessionFavorite;
use App\Product;
use App\Sale;
use Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\UserRegisterMessage;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportController implements FromView
{
    //

    /*
    ** REPORTE GENERAL DE VISITANTES POR EVENTO, INCLUYENDO TODOS LOS CAMPOS DINAMICOS
    */

    public function getFullVisitorReport(Request $request){
      set_time_limit(0);
      $eventId = $request->eventId;

      $formData= DB::table('event_forms')->where('event_id', $eventId)->where('form_id',5)->pluck('form_id');

    //  dd($formData);

      $visitorInfo = [];

      if(count($formData)>0){

        $formId = $formData[0];

        $users = User::from('users as u')
                    ->join('user_events as ue', 'ue.user_id', 'u.id')
                    ->where('ue.user_type_id', 5)
                    ->where('ue.event_id', $eventId)
                    ->select('u.id as userId', 'u.userFirstName', 'u.userLastName', 'ue.id as user_event_id')
                    ->get();



        $questionTags =  DB::table('forms as f')
                          ->join('form_sections as fs', 'fs.form_id', 'f.id')
                          ->join('form_section_fields as fsf', 'fsf.form_section_id', 'fs.id')
                          ->join('fields as fi', 'fi.id', 'fsf.field_id')
                          ->join('event_forms as ef', 'ef.form_id', 'f.id')
                          ->where('ef.event_id', $eventId)
                          ->where('fs.section_id', 1)
                          ->where('f.form_type_id', 5)
                          ->select('f.id as form_id', 'fi.fieldText as tag', 'fsf.id as section_field_id')
                          ->get();

        $tmpl = '<table>
                   <thead>
                    <tr>
                      <th> Nombre </th>';

                   foreach ($questionTags as $tag) {
                     $tmpl .= '<th>' . $tag->tag . '</th>';
                   }


         $tmpl .=  '</tr>
                  </thead>
                  <tbody>';

        foreach ($users as $user) {
            $userId = $user->userId;
            $userEventId = DB::table('user_events')->where('user_id', $user->userId)->pluck('id');



            /*
            $userEventForms = DB::table('user_event_forms as uef')
                                ->join('forms as f', 'f.id', 'uef.form_id')
                                ->join('form_sections as fs', 'fs.form_id', 'f.id')
                                ->join('form_section_fields as fsf', 'fsf.form_section_id', 'fs.id')
                                
                                ->join('fields as fi', 'fi.id', 'fsf.field_id')
                                
                                ->where('uef.user_event_id', $user->user_event_id)
                              
                                
                                ->where('fs.section_id', 1)
                                ->where('f.form_type_id', 5)
                                ->select('f.id as form_id', 'fi.fieldText as tag', 'fsf.id as section_field_id')
                                ->get();
            */


            $userEventForms = DB::table('user_event_forms as uef')
                                ->join('forms as f', 'f.id', 'uef.form_id')
                                ->join('form_sections as fs', 'fs.form_id', 'f.id')
                                ->join('form_section_fields as fsf', 'fsf.form_section_id', 'fs.id')
                                ->where('uef.user_event_id', $user->user_event_id)
                                ->where('fs.section_id', 1)
                                ->where('f.form_type_id', 5)
                                ->select('f.id as form_id', 'fsf.id as section_field_id')
                                ->get();


            $tmpl .= '<tr>
                        <td>' . $user->userLastName . ', ' . $user->userFirstName . '</td>';                    
           // printf("<span style='font-weight: 800'>" . $user->userFirstName . "   " . $userId . "</span><br />");
        
            foreach ($userEventForms as $key) {
             
              /* Obtener las respuestas segun form_section_field_id*/
              $answer = $this->getAnswerTemplate($key->section_field_id, $userId);
                            
              
             //  printf($key->tag . ": " . $answer . "<br />"); 

              
              $tmpl .= '<td>'. $answer .'</td>';




              //$visitorInfo['fullName'] = $user->userLastName . ", " . $userFirstName;
             // $visitorInfo[$key->tag] = $key->tag;
              
            }

            

           /* $fields = Field::from('fields as F')
                          ->join('form_section_fields as FSF', 'FSF.field_id', 'F.id')
                          ->join('form_sections as FS', 'FS.id', 'FSF.form_section_id')
                          ->join('forms as FO', 'FO.id', 'FS.form_id')
                          ->join('event_forms as EF', 'EF.form_id', 'FO.id')
                          ->join('form_section_field_answers as fsfa', 'fsfa.form_section_field_id', 'FSF.id')
                          ->join('user_event_forms as uef', 'uef.form_id', 'FO.id')
                          ->where('EF.event_id', $eventId)
                          ->where('FS.form_id', $formId) //form Visitantes
                          ->where('FSF.fieldStatus', 1) //Estado habilitado 1, deshabilitado 0
                          ->where('FS.section_id', 1) //section Registro
                          ->where('FO.form_type_id', 5) //5 pertenece a visitantes
                          ->where('uef.user_event_id', $userEventId[0])
                          //->orderBy('FSF.fieldOrder', 'F.created_at', 'asc')
                          ->select([\DB::raw('FSF.id as IDA, F.id as ID, F.fieldText as TAG, F.data_type_control_id as CONTROLTYPE')])
                          ->orderBy('FSF.fieldOrder' , 'F.created_at', 'desc')
                          ->get();

             foreach ($fields as $field) {

               printf($user->userFirstName . " " . $field->TAG . "<br />");

             } */

          
          }
          $tmpl .= '    </tr>
                        </tbody>
                      </table>';

         return $tmpl;


        }//End if
        else{

          echo "No existen campos dinámicos, consulta normal";
        }


      


    }



    /* Mostrar respuesta segun tipo de campo de la pregunta*/
    public function getAnswerTemplate($form_section_field_id, $userId){


      /*
      * Obtener id del campo (field_id)
      */

      $fieldId= FormSectionField::where('id', $form_section_field_id)->pluck('field_id');

      /*Obtener el tipo de campo*/

      $fieldType = Field::from('fields as f')
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

      switch ($fieldType[0]) {
        // Input
        case "1":

          if((count($answer) > 0) &&  $answer[0]->Value != null){
            return ($answer[0]->Value);
          }
          else{
            return "";
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
            return "";
          }
            


          break;


        case "3":

          break;


        case "4":

          break;

        case "5":

          break;
        
        default:
           return "";
          break;
      }



     


    }


    public function view(): View{

    	$tmpl = $this->getFullVisitorReport(Request $request)

    	 return view('backend.admin.exports.visitors', ['tmpl' => $tmpl]);

    }
}
