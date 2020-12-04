<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Assigner_hospital_a_communes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitaux = Hospital::all();
        return view('hospital.index', compact('hospitaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospital.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Start transaction!
        DB::beginTransaction();
        try {
        $validator = Validator::make($request->all(), [
            'nom' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'code_hospital' => 'nullable|string|max:255',
            'maximum_visites_par_jour' => 'nullable',
            'commune' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
        ]);
      
       $input = $request->all();
      $newHospital = Hospital::create($input);
     
    } catch(ValidationException $e)
    {
        // Rollback and then redirect
        // back to form with errors
        DB::rollback();
        Session::flash('error', $e->getErrors()); 
        return redirect()->back()
            ->withInput();
    } catch(\Exception $e)
    {
        DB::rollback();
        throw $e;
    }

    //les assignatiions
    try {
        if($request->multiclass )
        {
       
            foreach($request->multiclass as $key => $teach){
                $data2 = array('id_hospital'=> $newHospital->id,
                    'commune'=> $request->multiclass[$key]);
                $checkExist = Assigner_hospital_a_communes::where('id_hospital', $newHospital->id)
                                ->where('commune', $request->multiclass[$key])
                                ->first();
                             
                if($checkExist){
                    Session::flash('error', 'ERReur ! Une ou plusieurs assignations existaient deja pour cet hopital.!'); 
                    return redirect()->back()
                    ->withInput();
                }
                Assigner_hospital_a_communes::insert($data2);
              
                }
       }
    } catch(ValidationException $e)
    { 
        // Rollback and then redirect
        // back to form with errors
        DB::rollback();
        Session::flash('error', $e->getErrors()); 
        return redirect()->back()
            ->withInput();
    }catch(\Exception $e)
    {
        DB::rollback();
        throw $e;
    }  
    // If we reach here, then data is valid and working. Commit the queries!
    DB::commit();
    Session::flash('succes', 'SUCCES !'); 
    return redirect(route('hospital.index'));
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital = Hospital::find($id);

        if (empty($hospital)) {
            return redirect(route('hospital.index'));
        }
        $assignations = Assigner_hospital_a_communes::where('id_hospital', $id)
                     ->get();

        return view('hospital.show',compact(['hospital', 'assignations']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $hospital = Hospital::findOrFail($id);
        $anciennesAssignations=Assigner_hospital_a_communes::where('id_hospital',$hospital->id)->get();
        if (empty($hospital)) {
            return redirect(route('hospital.index'));
        }

        return view('hospital.edit',compact(['hospital','anciennesAssignations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'maximum_visites_par_jour' => 'nullable',
            'commune' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput();
       }
       $hospital = Hospital::findOrFail($id);

        if (empty($hospital)) {
            return redirect(route('hospital.index'));
        }
        $hospital->update($request->all());

        //ann delete assignations ki gen rapport avel
        if($request->multiclass )
        {
            $oldAssignations = Assigner_hospital_a_communes::where('id_hospital', $id)
                            ->get();
            foreach($oldAssignations as $ac){
                $ac->delete();
            }

            
            foreach($request->multiclass as $key => $teach){
                $data2 = array('id_hospital'=> $id,
                'commune'=> $request->multiclass[$key]);
                Assigner_hospital_a_communes::insert($data2);
            }
        }
        Session::flash('succes', 'SUCCES !'); 
        return redirect(route('hospital.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hospital = Hospital::findOrFail($id);

        if (empty($hospital)) {
            return redirect(route('hospital.index'));
        }

        Hospital::where('id', $id)->delete();
        Session::flash('succes', 'SUCCES !'); 
        return redirect(route('hospital.index'));
    }
}
