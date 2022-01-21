<?php

namespace Modules\Extrafield\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Extrafield\Entities\Extrafield;
use Modules\Extrafield\Http\Requests\CreateExtrafieldRequest;
use Modules\Extrafield\Http\Requests\UpdateExtrafieldRequest;
use Modules\Extrafield\Repositories\ExtrafieldRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ExtrafieldController extends AdminBaseController
{
    /**
     * @var ExtrafieldRepository
     */
    private $extrafield;

    public function __construct(ExtrafieldRepository $extrafield)
    {
        parent::__construct();

        $this->extrafield = $extrafield;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$extrafields = $this->extrafield->all();

        return view('extrafield::admin.extrafields.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('extrafield::admin.extrafields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateExtrafieldRequest $request
     * @return Response
     */
    public function store(CreateExtrafieldRequest $request)
    {
        $this->extrafield->create($request->all());

        return redirect()->route('admin.extrafield.extrafield.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('extrafield::extrafields.title.extrafields')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Extrafield $extrafield
     * @return Response
     */
    public function edit(Extrafield $extrafield)
    {
        return view('extrafield::admin.extrafields.edit', compact('extrafield'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Extrafield $extrafield
     * @param  UpdateExtrafieldRequest $request
     * @return Response
     */
    public function update(Extrafield $extrafield, UpdateExtrafieldRequest $request)
    {
        $this->extrafield->update($extrafield, $request->all());

        return redirect()->route('admin.extrafield.extrafield.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('extrafield::extrafields.title.extrafields')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Extrafield $extrafield
     * @return Response
     */
    public function destroy(Extrafield $extrafield)
    {
        $this->extrafield->destroy($extrafield);

        return redirect()->route('admin.extrafield.extrafield.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('extrafield::extrafields.title.extrafields')]));
    }
}
