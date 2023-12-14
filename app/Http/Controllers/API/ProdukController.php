<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=produk::getproduk()->paginate(10);
        //$data['message']='success';
        return response()->json($data);   
     }

    /**
     * Show the form for creating a new resource.
     */
    public function Kategori()
    {
        $data=Kategori::all();
        //$data['message']='success';
        return response()->json($data);   
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi=$request->validate([
            'kategori_id'=>'required',
            'nama_produk'=>'required',
            'harga_produk'=>'',
            'deskripsi_produk'=>'',
            'gambar_produk' => ''
        ]);    
        try{
            $fileName = time().$request->file('gambar_produk')->getClientOriginalName();
            $path = $request->file('gambar_produk')->storeAs('uplouds/produk',$fileName);
            $validasi['gambar_produk']=$path;
            $response = produk::create($validasi);
            return response()->json([
                'success' => true,
                'message'=>'success',
                        // 'data'=>$response
                // 'id'=>$response->id
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
                ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data=produk::find($id);
        //$data['message']='success';
        return response()->json($data);       }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        {
            $validasi=$request->validate([
                'kategori_id'=>'required',
                'nama_produk'=>'required',
                'harga_produk'=>'',
                'deskripsi_produk'=>'',
                'gambar_produk' => ''
            ]);    
            try{
              if ($request->file('gambar_produk')){
                $fileName = time().$request->file('gambar_produk')->getClientOriginalName();
                $path = $request->file('gambar_produk')->storeAs('uplouds/produk',$fileName);
                $validasi['gambar_produk']=$path;
            }
                $response =produk::find($id);
                $response->update($validasi);
                return response()->json([
                    'success' => true,
                    'message'=>'success',
                            // 'data'=>$response
                    // 'id'=>$response->id
                ]);
            }catch (\Exception $e) {
                return response()->json([
                    'message'=>'Err',
                    'errors'=>$e->getMessage()
                    ]);
            }
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $produk=produk::find($id);
            $produk->delete();
            return response()->json([
                'success'=>true,
                'message'=>"Data Deleted"
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage(),
                ]);
        }    
    }
}
