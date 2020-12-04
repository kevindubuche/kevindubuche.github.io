<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Event;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Session;
use Log;
use PDF;



class PatientController extends Controller
{
    public function __construct()
{
    // Middleware only applied to these methods
    $this->middleware('admin', [
        'only' => [
            'index' ,
            'show',
            'destroy'// Could add bunch of more methods too
        ]
    ]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function indexcsv()
    {
        $allHospital = Hospital::all();
        $patients = Patient::all();
        return view('patients.indexcsv', compact('patients','allHospital'));
    }

    public function patients_set_up_csv()
    {
        
        $patients = Patient::all();
        return view('patients.indexcsv', compact('patients'));
    }


 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        function isJourFerier($jour)
        {
             $array_des_jours_non_ouvrables = getJoursFeriers($jour);
             Log::debug((new DateTime($jour))->format('Y-m-d 00:00:00'), $array_des_jours_non_ouvrables);
             if(in_array((new DateTime($jour))->format('Y-m-d 00:00:00'), $array_des_jours_non_ouvrables))
             {
                Log::debug('yes');
                  return true;
             }
                
             else
                 return false;
        
        }
        function  isHospitalSaturePourRendezVous($date, $id_hospital)
        {
            //recupere le nombre de rendez-vous pour cette journee pour l'hopital
            $total_rendez_vous_de_la_journee_pour_cet_hopital = Patient::where('date_rendez_vous',$date)
            ->where('hospital',$id_hospital)
            ->count();
            //verifie si ce nombre est inferieur au maximum journalier
            if($total_rendez_vous_de_la_journee_pour_cet_hopital < getMaximumVisitesParJour($id_hospital) )
             return false;
            else 
               return true;

        }
         function setHospital($zoneDuPatient)
         {
                // fonction qui determine l'hopital ou le patient se rendra en 
                // fonction de la commune ou il vit
                $hospital_du_patient = Hospital::
                select('hospitals.*')
                ->join('assigner_hospital_a_communes','assigner_hospital_a_communes.id_hospital','=','hospitals.id')//qui sont dans l'horaire de l'etudiant
                ->where('assigner_hospital_a_communes.commune',$zoneDuPatient)
                ->first();
                if($hospital_du_patient)
                {
                    return $hospital_du_patient->id;
                }//on met un endroit par defaut
                return 1; //onramplacera ce chiffre par l'ID du central

        }
            function getJoursFeriers($dernier_rendez_vous)
            {
                $liste_des_jours_non_ouvrables = Event::
                select('events.start')
                ->where('title','ferier')
                ->whereDate('start', '>=', $dernier_rendez_vous)->get();
                $les_elements_de_la_liste_des_jours_non_ouvrables = $liste_des_jours_non_ouvrables->toArray();
                $array_des_jours_non_ouvrables = [];
                foreach($les_elements_de_la_liste_des_jours_non_ouvrables as $item)
                {
                    array_push($array_des_jours_non_ouvrables,$item['start']);
                }
                return $array_des_jours_non_ouvrables;
            }

            function getMaximumVisitesParJour($hospital)
            {
                $hospital_trouve = Hospital::where('id',$hospital)->first();
                $maximum_visites_par_jour = $hospital_trouve->maximum_visites_par_jour;
                return $maximum_visites_par_jour;
            }
            function setDateRendezVous($hospital, $commencer_a_aprtir_de_cette_datte)
        // fonction qui determine la date du rendez-vous du patient
            {
                //ballayer tous les jours a partir de commencer_a_aprtir_de_cette_datte juska ce kon trouve une date non ferier non remplie
                //recupere la derniere date d'un rendez-vous > ajourd'hui
                while(
                    isJourFerier($commencer_a_aprtir_de_cette_datte->add(new DateInterval('P1D'))->format('Y-m-d 00:00:00')) || 
                    isHospitalSaturePourRendezVous($commencer_a_aprtir_de_cette_datte->format('Y-m-d 00:00:00'), $hospital))
                {
                //on ne fait rien. on laisse l'incrementation se realiser.
                }

                $date = new DateTime($commencer_a_aprtir_de_cette_datte->format('Y-m-d 00:00:00'));
                return $date;

               
            }

        $input = $request->all();
        $input['hospital'] = setHospital($input['commune']); 
         $input['date_rendez_vous'] = setDateRendezVous($input['hospital'], new DateTime() );
     
     
        if($input['submit']=='patient_demande_une_autre_date')
        {
           //on demande laconfirmation de la date de rendez-vous proposee    
           //sil n y avait pas de date on part de zero, premier submit la
        $nouvelle_date_de_rendez_vous = $input['date_rendez_vous']; 
        //s'il y avait une date on prend la date dans le request
        if(!empty($request->date_rendez_vous))//sa se PA premier submit la
        {
            //nou ajoute yon jou sou date precedente la ki te nan request la
            $nouvelle_date_de_rendez_vous = setDateRendezVous($input['hospital'], (new DateTime($request->date_rendez_vous))); 

        }
       
        return redirect()->back()->withInput($request->all())->with('date_rendez_vous',$nouvelle_date_de_rendez_vous);   
       
        }
        else
        {
               
            $input['date_rendez_vous'] = $request->date_rendez_vous;
            $newPatient = Patient::create($input);
            Session::flash('succes', 'SUCCES !'); 
            return view('patients.fiche', compact(['newPatient'])); 
        }
      
        //si la variable date_rendez_vous existe ou va afficher les bouttons ACCEPTER & AUTRE_DATE

       
       
    }
    
    public function fichePatient(Request $request)
    {
       dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newPatient = Patient::find($id);
        return view('patients.show')->with('newPatient',$newPatient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pat = Patient::find($id);

        if (empty($pat)) {

            return redirect()->route('patients.index')->with('error','Patient introuvable!');
        }

        Patient::where('id', $id)->delete();
        Session::flash('succes', 'SUCCES !');
        return redirect()->route('patients.index')->with('success','Patient supprimmé avec succès !');
    }

    public function exportCsv(Request $request)
    {
     
        $patients = Patient::where('id', '>', '0');//condition toujours vraie
        if($request->hospital != "Tous") {                      
            $patients->where('hospital', $request->hospital);
        }
        if($request->sexe != "Tous") {                      
            $patients->where('sexe', $request->sexe);
        }
        if($request->raison_test != "Tous") {                      
            $patients->where('raison_test', $request->raison_test);
        }
        if(!empty($request->date_rendez_vous_debut)  && !empty($request->date_rendez_vous_fin) ) {                      
            $patients->whereBetween('date_rendez_vous',
            [ (new DateTime($request->date_rendez_vous_debut))->format('Y-m-d H:i:s'),
            (new DateTime($request->date_rendez_vous_fin))->format('Y-m-d H:i:s')]);
        }
         if(!empty($request->created_at_debut)  && !empty($request->created_at_fin) ) {                      
            $patients->whereBetween('created_at',
            [ (new DateTime($request->created_at_debut))->format('Y-m-d H:i:s'),
            (new DateTime($request->created_at_fin))->format('Y-m-d H:i:s')]);
        }
        $patients = $patients->orderBy('created_at', 'DESC')->get();

        if($request->submit =='download')
        {
       $fileName = 'MSPP_DELR_Rendez-vous_COVID_19.csv';
    //    $patients = Patient::all();
    
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0",
                "Charset"             =>"UTF-8",
                "Content-Encoding"    => "UTF-8"
            );
    
            // $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');
            $columns = array('ID patient','Nom','Prénom','Sexe','Adresse','Téléphone','Raison','Date de rendez-vous','Hôpital','Date de création');
            
            $callback = function() use($patients, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
               // dd('kkk');
                foreach ($patients as $patient) {
                    $row['ID patient']  = $patient->Hospital->code_hospital.'-'.$patient->id ;
                    $row['Nom']  = $patient->nom;
                    $row['Prénom']    = $patient->prenom;
                    $row['Sexe']    = $patient->sexe;
                    $row['Adresse']  = $patient->departement.' '.$patient->commune.' '.$patient->rue ;
                    $row['Téléphone']  = $patient->telephone;
                    $row['Raison']  = $patient->raison_test;
                    $row['Date de rendez-vous']  = $patient->date_rendez_vous;
                    $row['Hôpital']  = $patient->Hospital->nom ;
                    $row['Date de création']  = $patient->created_at->format('d-m-y');
    
                    fputcsv($file, array($row['ID patient'], $row['Nom'], $row['Prénom'], $row['Sexe'], $row['Adresse'], $row['Téléphone'], $row['Raison'], $row['Date de rendez-vous'], $row['Hôpital'], $row['Date de création']));
                }
                
                fclose($file);
            };
    
            return response()->stream($callback, 200, $headers);
        }
         else
        {
            $inputs =$request->all();
            $allHospital = Hospital::all();
            return view('patients.indexcsv', compact('patients','allHospital','inputs'));
        }
        }



       // Generate PDF
       public function createPDF(Request $request) {
        // retreive all records from db
   
        $newPatient = Patient::findOrFail($request->id);
        // share data to view
        
        view()->share('patients.fichePatientHtml',$newPatient);
        $pdf = PDF::loadView('patients.fichePatientHtml', compact('newPatient'));
    
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }
}
