<?php

namespace App\Modules\Service\Package;

use App\Modules\Models\Package\Package;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PackageService extends Service
{
    protected $package;

    public function __construct(Package $package)
    {
        $this->package = $package;
    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->package->get();

        return DataTables::of($query)
            ->addIndexColumn()
            
            ->editColumn('image',function(Package $package) {
                if(isset($package->image)){
                    return '<img src="'.($package->image).'" width="100px">';
                } else {
                    ;
                }
            })
            ->editColumn('type',function(Package $package) {
                return ucfirst($package->type);
            })
            ->editcolumn('actions',function(Package $package) {
                $editRoute =  route('package.edit',$package->id);
                $deleteRoute =  route('package.destroy',$package->id);
                return getTableHtml($package,'actions',$editRoute,$deleteRoute);
            })->rawColumns(['status','image'])->make(true);
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['presentation_photo'] = (isset($data['presentation_photo']) ?  $data['presentation_photo'] : '')=='on' ? 'active' : 'in_active';
            $data['studio_photo'] = (isset($data['studio_photo']) ?  $data['studio_photo'] : '')=='on' ? 'active' : 'in_active';
            $package = $this->package->create($data);
            return $package;
        } catch (ModelNotFoundException $ex) {
            return $ex->getMessage();

        }
    }

    /**
     * Paginate all package
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->package->orderBy('id', 'desc')->where('status','active')->paginate($filter['limit']);
    }

    /**
     * Get all package
     *
     * @return Collection
     */
    public function all()
    {
        return $this->package->all();
    }

    /**
     * Get all packages with supervisor type
     *
     * @return Collection
     */


    public function find($packageId)
    {
        try {
            return $this->package->find($packageId);
        } catch (ModelNotFoundException $ex) {
            return $ex->getMessage();

        }
    }


    public function update($packageId, array $data)
    {
        try {

            $package = $this->package->find($packageId);
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['presentation_photo'] = (isset($data['presentation_photo']) ?  $data['presentation_photo'] : '')=='on' ? 'active' : 'in_active';
            $data['studio_photo'] = (isset($data['studio_photo']) ?  $data['studio_photo'] : '')=='on' ? 'active' : 'in_active';
            $package = $package->update($data);
            //$this->logger->info(' created successfully', $data);

            return $package;
        } catch (ModelNotFoundException $ex) {
            //$this->logger->error($e->getMessage());
            return $ex->getMessage();

        }
    }

    /**
     * Delete a package
     *
     * @param Id
     * @return bool
     */
    public function delete($packageId)
    {
        try {
            $package = $this->package->find($packageId);
            $package->delete();
        } catch (ModelNotFoundException $ex) {
            return $ex->getMessage();

        }
    }


    /**
     * write brief description
     * @param $name
     * @return mixed
     */
}
