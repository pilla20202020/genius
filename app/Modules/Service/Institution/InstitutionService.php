<?php

namespace App\Modules\Service\Institution;

use App\Modules\Models\Institution\Institution;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class InstitutionService extends Service
{
    protected $institution;

    public function __construct(Institution $institution)
    {
        $this->institution = $institution;
    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->institution->get();

        return DataTables::of($query)
            ->addIndexColumn()
            
            ->editColumn('image',function(Institution $institution) {
                if(isset($institution->image)){
                    return '<img src="'.($institution->image).'" width="100px">';
                } else {
                    ;
                }
            })
            ->editColumn('status',function(Institution $institution) {
                if($institution->status == 'active'){
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">In-Active</span>';
                }
            })
            ->editcolumn('actions',function(Institution $institution) {
                $editRoute =  route('institution.edit',$institution->id);
                $deleteRoute =  route('institution.destroy',$institution->id);
                return getTableHtml($institution,'actions',$editRoute,$deleteRoute);
            })->rawColumns(['status','image'])->make(true);
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $institution = $this->institution->create($data);
            return $institution;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all Institution
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->institution->orderBy('id', 'desc')->where('status','active')->paginate($filter['limit']);
    }

    /**
     * Get all Institution
     *
     * @return Collection
     */
    public function all()
    {
        return $this->institution->all();
    }

    /**
     * Get all Institutions with supervisor type
     *
     * @return Collection
     */


    public function find($institutionId)
    {
        try {
            return $this->institution->find($institutionId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($institutionId, array $data)
    {
        try {

            $institution = $this->institution->find($institutionId);
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $institution = $institution->update($data);
            //$this->logger->info(' created successfully', $data);

            return $institution;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a Institution
     *
     * @param Id
     * @return bool
     */
    public function delete($institutionId)
    {
        try {
            $institution = $this->institution->find($institutionId);
            $institution->delete();
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
