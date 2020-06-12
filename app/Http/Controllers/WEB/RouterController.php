<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\Router;

class RouterController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $columns = [
                0 => 'sap_id',
                1 => 'host_name',
                2 => 'ip_address',
                3 => 'mac_address',
            ];
            $queryString = Router::latest();
            $totalData = $queryString->count();
            $start = $request->input('start');
            $length = $request->input('length');

            if (! empty($request->input('search.value'))) {
                $search = $request->input('search.value');
                $queryString = $queryString->where('sap_id', 'LIKE', "%{$search}%")
                                            ->orWhere('host_name', 'LIKE', "%{$search}%")
                                            ->orWhere('ip_address', 'LIKE', "%{$search}%")
                                            ->orWhere('mac_address', 'LIKE', "%{$search}%");
            }

            $totalFiltered = $queryString->count();
            if ($length != -1 && $length != 'all') {
                $queryString = $queryString->offset($start)->limit($length);
            }
            //$data = $queryString->get();
            if (! empty($request->input('order'))) {
                $sortCol = $columns[intval($request->input('order.0.column'))];
                $dir = $request->input('order.0.dir');
                $queryString = $queryString->orderBy($sortCol, $dir);
            }
            $data = $queryString->get()->toArray();
            foreach($data as $key => $val){
                $data[$key]['action'] = '<a class="btn btn-sm btn-primary mr-2" href="'.route('router.edit',$val['id']).'">Edit</a><button type="submit" class="btn btn-sm btn-danger delete-router" data-id="'.$val['id'].'">Delete</button></form>';
            }
            //dd($data);
            $jsonData = [
                'draw' => intval($request->input('draw')),
                'recordsTotal' => intval($totalData),
                'recordsFiltered' => intval($totalFiltered),
                'data' => $data,
            ];

            return $jsonData;
        }
        return view('index');
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('router');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //dd($request);
        $request->validate([
            'sap_id' => 'required|unique:routers,sap_id|max:18',
            'host_name' => ['required','regex:/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/','unique:routers,host_name','max:14'],
            'ip_address' => 'required|ipv4|unique:routers,ip_address',
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/|unique:routers,mac_address|max:17'
        ]);

        $router = Router::create($request->all());

        return redirect()->route('router.index')->with('success','Router added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\router  $router
     * @return \Illuminate\Http\Response
     */
    /* public function show(router $router)
    {
        return view('products.show',compact('router'));
    } */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $router = Router::findOrFail($id);
        return view('edit',compact('router'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  \App\model\router  $router
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $router = Router::findOrFail($id);
        $request->validate([
            'sap_id' => 'required|max:18|unique:routers,sap_id,'.$id,
            'host_name' => ['required','regex:/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/','unique:routers,host_name,'.$id,'max:14'],
            'ip_address' => 'required|ipv4|unique:routers,ip_address,'.$id,
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/|max:17|unique:routers,mac_address,'.$id,
        ]);
  
        $router->update($request->all());
  
        return redirect()->route('router.index')
                        ->with('success','Detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $router = Router::findOrFail($id);
            $router->delete();
            return response()->json(['status' => true, 'message' => 'Details deleted successfully', 'data' => null]);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

}
