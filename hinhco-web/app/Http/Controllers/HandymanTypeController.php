<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HandymanType;
use App\Http\Requests\HandymanTypeRequest;
use Yajra\DataTables\DataTables;

class HandymanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = [
            'status' => $request->status,
        ];
        $pageTitle = trans('messages.list_form_title', ['form' => trans('messages.handymantype')]);
        $auth_user = authSession();
        $assets = ['datatable'];
        return view('handymantype.index', compact('pageTitle', 'auth_user', 'assets', 'filter'));
    }




    public function index_data(DataTables $datatable, Request $request)
    {
        $query = HandymanType::query();
        $filter = $request->filter;
        $user = auth()->user();
        if (isset($filter)) {
            if (isset($filter['column_status'])) {
                $query->where('status', $filter['column_status']);
            }
        }
        if ($user->hasAnyRole(['admin'])) {
            $query->withTrashed();
        }
        if ($user->hasAnyRole(['provider'])) {
            $adminIds = \App\Models\User::whereIn('user_type', ['admin', 'demo_Admin'])->pluck('id')->toArray();
            $idsToFilter = array_merge([$user->id], $adminIds);
            $query->whereIn('created_by', $idsToFilter)->withTrashed();
        }
        return $datatable->eloquent($query)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" class="form-check-input select-table-row"  id="datatable-row-' . $row->id . '"  name="datatable_ids[]" value="' . $row->id . '" onclick="dataTableRowCheck(' . $row->id . ')">';
            })

            ->editColumn('name', function ($query) use ($user) {
                if ($query->created_by === $user->id || $user->hasRole(['admin', 'demo_admin'])) {
                    // if (auth()->user()->can('handymantype edit')) {
                    $link = '<a class="btn-link btn-link-hover" href=' . route('handymantype.create', ['id' => $query->id]) . '>' . $query->name . '</a>';
                } else {
                    $link = $query->name;
                }
                return $link;
            })


            ->editColumn('commission', function ($query) {
                $commission = getPriceFormat($query->commission);
                if ($query->type === 'percent') {
                    $commission = $query->commission . '%';
                }
                return $commission;
            })
            ->editColumn('type', function ($query) {
                return ucfirst($query->type);
            })
            ->editColumn('status', function ($query) use ($user) {
                if ($query->created_by === $user->id || $user->hasRole(['admin', 'demo_admin'])) {
                    $disabled = $query->trashed() ? 'disabled' : '';
                    return '<div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                    <div class="custom-switch-inner">
                        <input type="checkbox" class="custom-control-input  change_status" data-type="handyman_type_status" ' . ($query->status ? "checked" : "") . '  ' . $disabled . ' value="' . $query->id . '" id="' . $query->id . '" data-id="' . $query->id . '">
                        <label class="custom-control-label" for="' . $query->id . '" data-on-label="" data-off-label=""></label>
                    </div>
                </div>';
                } else {
                    return '-';
                }
            })
            ->addColumn('created_by', function ($handymantype) use ($user) {
                $display_name = $handymantype->created_by ? optional($handymantype->user)->first_name . ' ' . optional($handymantype->user)->last_name : '-';
                return $display_name;
            })
            ->addColumn('action', function ($handymantype) use ($user) {
                if ($handymantype->created_by === $user->id || $user->hasRole(['admin', 'demo_admin'])) {
                    return view('handymantype.action', compact('handymantype'))->render();
                } else {
                    return '-';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['check', 'name', 'action', 'status'])
            ->toJson();
    }

    /* bulck action method */
    public function bulk_action(Request $request)
    {
        $ids = explode(',', $request->rowIds);

        $actionType = $request->action_type;

        $message = 'Bulk Action Updated';
        switch ($actionType) {
            case 'change-status':
                $branches = HandymanType::whereIn('id', $ids)->update(['status' => $request->status]);
                $message = 'Bulk Photographer Type Status Updated';
                break;

            case 'delete':
                HandymanType::whereIn('id', $ids)->delete();
                $message = 'Bulk Photographer Type Deleted';
                break;

            case 'restore':
                HandymanType::whereIn('id', $ids)->restore();
                $message = 'Bulk Photographer Type Restored';
                break;

            case 'permanently-delete':
                HandymanType::whereIn('id', $ids)->forceDelete();
                $message = 'Bulk Photographer Type Permanently Deleted';
                break;

            default:
                return response()->json(['status' => false, 'message' => 'Action Invalid']);
                break;
        }

        return response()->json(['status' => true, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $auth_user = authSession();

        $handymantypedata = HandymanType::find($id);
        $pageTitle = trans('messages.update_form_title', ['form' => trans('messages.handymantype')]);

        if ($handymantypedata == null) {
            $pageTitle = trans('messages.add_button_form', ['form' => trans('messages.handymantype')]);
            $handymantypedata = new HandymanType;
        } else {
            if ($handymantypedata->created_by !== auth()->user()->id && !auth()->user()->hasRole(['admin', 'demo_admin'])) {
                return redirect(route('handymantype.index'))->withErrors(trans('messages.demo_permission_denied'));
            }
        }

        return view('handymantype.create', compact('pageTitle', 'handymantypedata', 'auth_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HandymanTypeRequest $request)
    {
        if (demoUserPermission()) {
            return redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $data = $request->all();

        if ($request->has('type') && $request->type == 'percentage') {
            $data['type'] = 'percent';
        }

        $result = HandymanType::updateOrCreate(['id' => $data['id']], $data);

        $message = trans('messages.update_form', ['form' => trans('messages.handymantype')]);
        if ($result->wasRecentlyCreated) {
            $message = trans('messages.save_form', ['form' => trans('messages.handymantype')]);
        }
        if ($request->is('api/*')) {
            return comman_message_response($message);
        }
        return redirect(route('handymantype.index'))->withSuccess($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (demoUserPermission()) {
            return redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $handymantype = HandymanType::find($id);
        $msg = __('messages.msg_fail_to_delete', ['item' => __('messages.handymantype')]);

        if ($handymantype != '') {
            $handymantype->delete();
            $msg = __('messages.msg_deleted', ['name' => __('messages.handymantype')]);
        }
        if (request()->is('api/*')) {
            return comman_message_response($msg);
        }
        return comman_custom_response(['message' => $msg, 'status' => true]);
    }
    public function action(Request $request)
    {
        if (demoUserPermission()) {
            return redirect()->back()->withErrors(trans('messages.demo_permission_denied'));
        }
        $id = $request->id;
        $handyman_type = HandymanType::withTrashed()->where('id', $id)->first();
        $msg = __('messages.not_found_entry', ['name' => __('messages.handyman')]);
        if ($request->type == 'restore') {
            $handyman_type->restore();
            $msg = __('messages.msg_restored', ['name' => __('messages.handyman')]);
        }
        if ($request->type === 'forcedelete') {
            $handyman_type->forceDelete();
            $msg = __('messages.msg_forcedelete', ['name' => __('messages.handyman_type')]);
        }
        if ($request->is('api/*')) {
            return comman_message_response($msg);
        }

        return comman_custom_response(['message' => $msg, 'status' => true]);
    }
}