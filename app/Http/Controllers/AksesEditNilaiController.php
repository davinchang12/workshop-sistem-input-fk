<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AksesEditNilai;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAksesEditNilaiRequest;

class AksesEditNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akseseditnilais = AksesEditNilai::get();
        return view('dashboard.akseseditnilai.admin.index', [
            'akseseditnilais' => $akseseditnilais
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'dosen')->get();
        return view('dashboard.akseseditnilai.admin.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAksesEditNilaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'jenisnilai' => 'required',
            'passwordakses' => 'required'
        ]);

        AksesEditNilai::create([
            'user_id' => $validatedData['user_id'],
            'jenisnilai' => strtoupper($validatedData['jenisnilai']),
            'passwordakses' => Hash::make($validatedData['passwordakses'])
        ]);

        return redirect('dashboard/akseseditnilai')->with('success', 'Akses berhasi diberikan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AksesEditNilai  $aksesEditNilai
     * @return \Illuminate\Http\Response
     */
    public function show(AksesEditNilai $aksesEditNilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AksesEditNilai  $aksesEditNilai
     * @return \Illuminate\Http\Response
     */
    public function edit(AksesEditNilai $aksesEditNilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAksesEditNilaiRequest  $request
     * @param  \App\Models\AksesEditNilai  $aksesEditNilai
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAksesEditNilaiRequest $request, AksesEditNilai $aksesEditNilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AksesEditNilai  $aksesEditNilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(AksesEditNilai $aksesEditNilai)
    {
        //
    }
}
