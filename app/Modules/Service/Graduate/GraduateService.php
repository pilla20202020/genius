<?php

namespace App\Modules\Service\Graduate;

use App\Modules\Models\Graduates\Graduates;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class GraduateService extends Service
{
    protected $graduate;

    public function __construct(Graduates $graduate)
    {
        $this->graduate = $graduate;
    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->graduate->get();

        $filter = (!empty($_GET["filter"])) ? ($_GET["filter"]) : ('');
        if (isset($filter)) {
            if ($filter == "eligible") {
                $query = $this->graduate->where('status','eligible')->get();
            }

            if ($filter == "register") {
                $query = $this->graduate->where('status', 'register')->get();
            }

            if ($filter == "incomplete") {
                $query = $this->graduate->where('status', 'incomplete')->get();
            }
            
        }

        return DataTables::of($query)
            ->addIndexColumn()
            
            ->editColumn('name',function(Graduates $graduate) {
                if(isset($graduate->first_name)){
                    return ucfirst($graduate->first_name) . ' ' . ucfirst($graduate->last_name);
                } else {
                    ;
                }
            })
            ->editColumn('status',function(Graduates $graduate) {
                if($graduate->status == 'eligible'){
                    return '<span class="badge badge-info">Eligible</span>';
                } elseif($graduate->status == 'register') {
                    return '<span class="badge badge-warning">Register</span>';
                } else {
                    return '<span class="badge badge-danger">Incomplete</span>';
                }
            })
            ->editcolumn('actions',function(Graduates $graduate) {
                $editRoute =  route('graduate.edit',$graduate->id);
                $deleteRoute =  route('graduate.destroy',$graduate->id);
                return getTableHtml($graduate,'actions',$editRoute,$deleteRoute);
            })->rawColumns(['status','image'])->make(true);
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['password'] = Hash::make($data['last_name']);
            $graduate = $this->graduate->create($data);
            return $graduate;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all graduate
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->graduate->orderBy('id', 'desc')->where('status','active')->paginate($filter['limit']);
    }

    /**
     * Get all graduate
     *
     * @return Collection
     */
    public function all()
    {
        return $this->graduate->all();
    }

    /**
     * Get all graduates with supervisor type
     *
     * @return Collection
     */


    public function find($graduateId)
    {
        try {
            return $this->graduate->find($graduateId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($graduateId, array $data)
    {
        try {

            $graduate = $this->graduate->find($graduateId);
            $data['password'] = Hash::make($data['last_name']);
            $graduate = $graduate->update($data);
            //$this->logger->info(' created successfully', $data);

            return $graduate;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a graduate
     *
     * @param Id
     * @return bool
     */
    public function delete($graduateId)
    {
        try {
            $graduate = $this->graduate->find($graduateId);
            $graduate->delete();
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
