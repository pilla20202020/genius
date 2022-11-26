<?php

namespace App\Modules\Service\Ceremony;

use App\Modules\Models\Ceremony\Ceremony;
use App\Modules\Models\Graduation\Graduation;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CeremonyService extends Service
{
    protected $graduation, $ceremony;

    public function __construct(Graduation $graduation, Ceremony $ceremony)
    {
        $this->graduation = $graduation;
        $this->ceremony = $ceremony;
    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->ceremony->get();

        return DataTables::of($query)
            ->addIndexColumn()
            
            ->editColumn('institution',function(Ceremony $ceremony) {
                if($ceremony->graduation->institution->name) {
                    return $ceremony->graduation->institution->name;
                }
            })

            ->editColumn('graduation',function(Ceremony $ceremony) {
                if($ceremony->graduation->title) {
                    return $ceremony->graduation->title;
                }
            })
            ->editColumn('status',function(Ceremony $ceremony) {
                if($ceremony->status == 'active'){
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Finished</span>';
                }
            })
            ->editcolumn('actions',function(Ceremony $ceremony) {
                $editRoute =  route('ceremony.edit',$ceremony->id);
                $deleteRoute =  route('ceremony.destroy',$ceremony->id);
                return getTableHtml($ceremony,'actions',$editRoute,$deleteRoute, $printRoute = null, $viewRoute = null, $btnAction = null);
            })->rawColumns(['status','image'])->make(true);
    }

    public function checkCeremony($request){
        $ceremony = $this->ceremony->where('graduation_id', $request->graduation_id)->where('time', $request->time)->first();
        if($ceremony) {
            Toastr()->error('At Given Time there is already another ceremony happening. Please Choose another time.','Sorry');
            return false;
        }
        



        return true;
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $ceremony = $this->ceremony->create($data);
            return $ceremony;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all ceremony
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->ceremony->orderBy('id', 'desc')->paginate($filter['limit']);
    }

    /**
     * Get all ceremony
     *
     * @return Collection
     */
    public function all()
    {
        return $this->ceremony->all();
    }

    /**
     * Get all ceremonys with supervisor type
     *
     * @return Collection
     */


    public function find($ceremonyId)
    {
        try {
            return $this->ceremony->find($ceremonyId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function findByGraduationId($graduationId)
    {
        try {
            return $this->ceremony->where('graduation_id', $graduationId)->latest()->get();
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($ceremonyId, array $data)
    {
        try {

            $ceremony = $this->ceremony->find($ceremonyId);
            $ceremony = $ceremony->update($data);
            //$this->logger->info(' created successfully', $data);

            return $ceremony;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a ceremony
     *
     * @param Id
     * @return bool
     */
    public function delete($ceremonyId)
    {
        try {
            $ceremony = $this->ceremony->find($ceremonyId);
            $ceremony->delete();
        } catch (Exception $e) {
            return null;
        }
    }

    public function addCeremonyTime(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $ceremony = $this->ceremony->create($data);
            return $ceremony;
        } catch (Exception $e) {
            return null;
        }
    }
    


    /**
     * write brief description
     * @param $name
     * @return mixed
     */
}
