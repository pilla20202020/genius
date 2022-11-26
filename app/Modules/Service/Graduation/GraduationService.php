<?php

namespace App\Modules\Service\Graduation;

use App\Modules\Models\Ceremony\Ceremony;
use App\Modules\Models\Graduation\Graduation;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class GraduationService extends Service
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
        $query = $this->graduation->get();

        return DataTables::of($query)
            ->addIndexColumn()
            
            ->editColumn('institution',function(Graduation $graduation) {
                if($graduation->institution->name) {
                    return $graduation->institution->name;
                }
            })
            ->editColumn('status',function(Graduation $graduation) {
                if($graduation->status == 'active'){
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Finished</span>';
                }
            })
            ->editcolumn('actions',function(Graduation $graduation) {
                $editRoute =  route('graduation.edit',$graduation->id);
                $deleteRoute =  route('graduation.destroy',$graduation->id);
                if($graduation->status == 'active') {
                    $btnAction =  $graduation->id;
                } else {
                    $btnAction =  null;
                    
                }
                return getTableHtml($graduation,'actions',$editRoute,$deleteRoute, $printRoute = null, $viewRoute = null, $btnAction);
            })->rawColumns(['status','image'])->make(true);
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $graduation = $this->graduation->create($data);
            return $graduation;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all graduation
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->graduation->orderBy('id', 'desc')->paginate($filter['limit']);
    }

    /**
     * Get all graduation
     *
     * @return Collection
     */
    public function all()
    {
        return $this->graduation->all();
    }

    /**
     * Get all graduations with supervisor type
     *
     * @return Collection
     */


    public function find($graduationId)
    {
        try {
            return $this->graduation->find($graduationId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($graduationId, array $data)
    {
        try {

            $graduation = $this->graduation->find($graduationId);
            $graduation = $graduation->update($data);
            //$this->logger->info(' created successfully', $data);

            return $graduation;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a graduation
     *
     * @param Id
     * @return bool
     */
    public function delete($graduationId)
    {
        try {
            $graduation = $this->graduation->find($graduationId);
            $graduation->delete();
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
