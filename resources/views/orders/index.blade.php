    @extends('layouts.admin')
    @section('page-title')
        {{ __('Orders') }}
    @endsection
    @section('title')
        <div class="d-inline-block">
            <h5 class="h4 d-inline-block text-white font-weight-bold mb-0">{{ __('Orders') }}</h5>
        </div>
    @endsection
    @section('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
        {{-- <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{{ __('Store Customers') }}</a></li> --}}
        <li class="breadcrumb-item active" aria-current="page">{{ __('Orders') }}</li>
    @endsection
    @section('action-btn')
        <div class="pr-2">
            <a href="{{ route('order.export') }}" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip"
                data-bs-placement="top" title="{{ __('Export') }}"><i class="ti ti-file-export"></i></a>
        </div>
    @endsection
    @section('filter')
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table mb-0 dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Orders') }}</th>
                                        <th scope="col" class="sort">{{ __('Date') }}</th>
                                        <th scope="col" class="sort">{{ __('Name') }}</th>
                                        <th scope="col" class="sort">{{ __('Value') }}</th>
                                        <th scope="col" class="sort text-end">{{ __('Payment Type') }}</th>
                                        <th scope="col" class="sort text-end">{{ __('Reciept') }}</th>
                                        <th scope="col" class="sort text-center">{{ __('Status') }}</th>
                                        <th scope="col" class="text-center">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <th scope="row">
                                                <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                class="btn btn-sm btn-white btn-icon btn-outline-primary order2_badge" data-bs-toggle="tooltip"
                                                title="{{__('Details')}}"
                                                data-toggle="tooltip">
                                                    <span class="btn-inner--text">{{$order->order_id[0] == '#' ?  $order->order_id : '#' .$order->order_id }}</span>
                                                </a>
                                            </th>
                                            <td class="order">
                                                <span
                                                    class="h6 text-sm font-weight-bold mb-0">{{ \App\Models\Utility::dateFormat($order->created_at) }}</span>
                                            </td>
                                            <td>
                                                <span class="client">{{ $order->name }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="value text-sm mb-0">{{ \App\Models\Utility::priceFormat($order->price) }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="taxes text-sm mb-0">{{ $order->payment_type }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if ($order->payment_type == 'Bank Transfer')
                                                    <a href="{{ asset(Storage::url($order->receipt)) }}" title="Invoice"
                                                        download>
                                                        <i class="fas fa-file-invoice"></i>
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex row justify-content-center">
                                                    <div class="col-auto">
                                                        @if ($order->status != 'Cancel Order')
                                                        <button type="button"
                                                            class="btn btn-sm {{ $order->status == 'pending' ? 'btn-soft-info' : 'btn-soft-success' }} btn-icon rounded-pill">
                                                            <span class="btn-inner--icon">
                                                                @if ($order->status == 'pending')
                                                                    <i class="fas fa-check soft-success"></i>
                                                                @else
                                                                    <i class="fa fa-check-double soft-success"></i>
                                                                @endif
                                                            </span>
                                                            @if ($order->status == 'pending')
                                                                <span class="btn-inner--text">
                                                                    {{ __('Pending') }}:
                                                                    {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                                </span>
                                                            @else
                                                                <span class="btn-inner--text">
                                                                    {{ __('Delivered') }}:
                                                                    {{ \App\Models\Utility::dateFormat($order->updated_at) }}
                                                                </span>
                                                            @endif
                                                        </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-sm btn-soft-danger btn-icon rounded-pill">
                                                                <span class="btn-inner--icon">
                                                                    @if ($order->status == 'pending')
                                                                        <i class="fas fa-check soft-success"></i>
                                                                    @else
                                                                        <i class="fa fa-check-double soft-success"></i>
                                                                    @endif
                                                                </span>
                                                                <span class="btn-inner--text">
                                                                    {{ __('Cancel Order') }}:
                                                                    {{ \App\Models\Utility::dateFormat($order->created_at) }}
                                                                </span>
                                                            </button>
                                                        @endif
                                                    </div>


                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="col-auto">
                                                    <span class="">
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="{{ route('orders.show', \Illuminate\Support\Facades\Crypt::encrypt($order->id)) }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ __('View') }}"><i
                                                                    class="ti ti-eye text-white"></i></a>
                                                        </div>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <a class="bs-pass-para align-items-center btn btn-sm d-inline-flex"
                                                                href="#" data-title="{{ __('Delete Lead') }}"
                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="delete-form-{{ $order->id }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="{{ __('Delete ') }}">

                                                                <i class="ti ti-trash"></i>

                                                            </a>
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $order->id], 'id' => 'delete-form-' . $order->id]) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
