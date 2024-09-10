@extends('admin.layouts.app')

@section('panel')
    @if (@json_decode($general->system_info)->version > systemDetails()['version'])
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card bg-warning mb-3 text-white">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-end">@lang('Version') {{ json_decode($general->system_info)->version }}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update ?')</h5>
                        <p>
                            <pre class="f-size--24">{{ json_decode($general->system_info)->details }}</pre>
                        </p>
                    </div>
                </div>
            </div>
        </div> --}}
    @endif
    @if (@json_decode($general->system_info)->message)
        <div class="row">
            @foreach (json_decode($general->system_info)->message as $msg)
                <div class="col-md-12">
                    <div class="alert border--primary border" role="alert">
                        <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                        <p class="alert__message">@php echo $msg; @endphp</p>
                        <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
      <div class="row clearfix mb-4">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="change-date">{{ __('Select Date')}}<span class="text-red">*</span></label>
                                <input name="created_at" id="change-date" type="date" class="form-control" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="align-items-center col-lg-8 col-md-8 col-sm-8 d-flex">
            <a class="btn btn--danger me-3" href="{{ route('admin.users.transfer') }}">
                    @lang('Transfer Guest')
                </a>
            @can('admin.request.booking.all')
                <a class="btn btn--danger me-3" href="{{ url('admin/booking/pending/check-in') }}">
                    @lang('Check In')
                </a>
                <a class="btn btn--danger me-3" href="{{ url('admin/book-room') }}">
                    @lang('Book A Room')
                </a>
                <a class="btn btn--danger me-3" href="{{ route('admin.request.booking.all') }}">
                    @lang('Booking Requests') <small class="fw-bold px-2 rounded bg-light text--danger">{{ $bookingRequestCount }}</small>
                </a>
            @endcan
        </div>
        </div>
        <div class="row">
            
             <!-- Total Daily Checkin-->
        <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                           <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($dailyCheckins)
                                <h3 class="mb-0" id="beds">{{ $dailyCheckins }}</h3>
                            @endisset
                             <p> Daily Checkin</p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        
        
         <!-- Total Daily Checkout-->
        <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($dailyCheckouts)
                                <h3 class="mb-0" id="beds">{{ $dailyCheckouts }}</h3>
                            @endisset
                             <p>Daily Checkout</p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        
        
           <!-- Total Monthly Checkin-->
             <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                           <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($monthlyCheckins)
                                <h3 class="mb-0" id="beds">{{ $monthlyCheckins }}</h3>
                            @endisset
                             <p>{{ $currentMonth. " Total Checkin"}}</p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        
        
         <!-- Total Monthly Checkout-->
        <div class="col-xxl-3 col-sm-6 position-relative mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($monthlyCheckouts)
                                <h3 class="mb-0" id="beds">{{ $monthlyCheckouts }}</h3>
                            @endisset
                             <p>{{ $currentMonth. " Total Checkout"}}</p>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row gy-4">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Room Type</h5>
                </div>
            </div>
        </div>
      
          <div class="row" id="roomTypesContainer">
            @foreach ($roomTypesWithCounts as $roomType)
            <div class="col-xxl-3 col-sm-6 position-relative gy-3">
                 <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="widget-two__icon b-radius--5 border border--primary bg-primary">
                                <i class="la la-city icon-color-efs"></i>
                            </div>
                            <div class="widget-two__content">
                                <h6 class="mb-0">{{ $roomType->name }} - {{ $roomType->accommodation->name }}</h6>
                                <p>Room Count: {{ $roomType->rooms_count }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('admin/hotel/bed-list?roomType=' . $roomType->id . '&accommodation=' . $roomType->accommodation->id) }}" class="widget-two__btn btn btn-outline--primary" style="cursor: pointer">View All</a>
                </div>
            </div>
            @endforeach
        </div> 
        <hr>

    <div class="row gy-4">
        
        <div class="col-xxl-3 col-sm-6">
            <x-widget bg="primary" icon="las la-users f-size--56" link="admin.users.all" title="Total Registered Guests" value="{{ $widget['total_users'] }}" />
        </div>

        <div class="col-xxl-3 col-sm-6">
            <x-widget bg="success" icon="las la-user-check f-size--56" link="admin.users.active" title="Active Registered Guests" value="{{ $widget['verified_users'] }}" />
        </div>
        
         
        <!-- Bed Total-->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-hospital-alt icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['rooms'])
                                <h3 class="mb-0" id="beds">{{ $widget['rooms'] }}</h3>
                            @endisset
                             <p>Total Rooms</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.hotel.bed.all') }}" class="widget-two__btn btn btn-outline--success" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
             <!-- Room Total-->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-bed icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['beds'])
                                <h3 class="mb-0" id="rooms">{{ $widget['beds'] }}</h3>
                            @endisset
                             <p>Total Beds</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.hotel.room.all') }}" class="widget-two__btn btn btn-outline--success" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
                
                        <!-- Total Bookings -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['total'])
                                <h3 class="mb-0" id="total">{{ $widget['total'] }}</h3>
                            @endisset
                             <p>Total Bookings</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.booking.all') }}" class="widget-two__btn btn btn-outline--primary" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        
                <!-- Active Booking -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success bg-success">
                            <i class="la la-clipboard-check icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['active'])
                                <h3 class="mb-0" id="active">{{ $widget['active'] }}</h3>
                            @endisset
                             <p>Active Booking</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.booking.active') }}" class="widget-two__btn btn btn-outline--success" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
       
        

        
        
        
        <!-- delayed_checkout -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--danger text--danger">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['delayed_checkout'])
                                <h3 class="mb-0" id="delayed_checkout">{{ $widget['delayed_checkout'] }}</h3>
                            @endisset
                             <p>Delayed Checkout</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.delayed.booking.checkout') }}" class="widget-two__btn btn btn-outline--danger" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>

      
      
       <!-- Pending Check-In -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--warning text--warning">
                            <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['pending_checkin'])
                                <h3 class="mb-0" id="pending_checkin">{{ $widget['pending_checkin'] }}</h3>
                            @endisset
                             <p>Pending Check-In</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.pending.booking.checkin') }}" class="widget-two__btn btn btn-outline--warning" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
               <!-- Upcoming Check-In -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info text--info">
                            <i class="la la-sign-in icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['upcoming_checkin'])
                                <h3 class="mb-0" id="upcoming_checkin">{{ $widget['upcoming_checkin'] }}</h3>
                            @endisset
                             <p>Upcoming Check-In</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.upcoming.booking.checkin') }}" class="widget-two__btn btn btn-outline--info" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        
        <!-- Upcoming Checkout -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info text--info">
                            <i class="la la-sign-out transform-rotate-180 icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['upcoming_checkout'])
                                <h3 class="mb-0" id="upcoming_checkout">{{ $widget['upcoming_checkout'] }}</h3>
                            @endisset
                             <p>Upcoming Checkout</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.upcoming.booking.checkout') }}" class="widget-two__btn btn btn-outline--info" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
       
        
     
     
        
        
                <!-- Today's Booked Rooms -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--dark bg-dark">
                            <i class="la la-check-circle icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['today_booked'])
                                <h3 class="mb-0" id="today_booked">{{ $widget['today_booked'] }}</h3>
                            @endisset
                             <p>Occupied Beds</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.hotel.room.getOccupiedRoom') }}" class="widget-two__btn btn btn-outline--dark" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        <!-- Today's Available Rooms -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info bg-info">
                            <i class="la la-hospital-alt icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['today_available'])
                                <h3 class="mb-0" id="today_available">{{ $widget['today_available'] }}</h3>
                            @endisset
                             <p>Vacant Beds</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.hotel.room.getVacantRoom') }}" class="widget-two__btn btn btn-outline--info" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        <!-- Today's Available Rooms -->
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--info bg-info">
                            <i class="la la-hospital-alt icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['vacant_rooms'])
                                <h3 class="mb-0" id="vacant_rooms">{{ $widget['vacant_rooms'] }}</h3>
                            @endisset
                             <p>Vacant Rooms</p>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        
         <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--danger text--danger">
                            <i class="fas fa-hotel icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                           
                            @isset($widget['amenities'])
                                <h3 class="mb-0" id="amenities">{{ $widget['amenities'] }}</h3>
                            @endisset
                             <p>Amenity</p>
                        </div>
                    </div>
            
                    <a href="{{ route('admin.hotel.amenity.all') }}" class="widget-two__btn btn btn-outline--danger" style="cursor: pointer">View All</a>
                </div>
            </div>
        </div>
        
        
        

        

        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Guests by Accommodation</h5>
                </div>
            </div>
        </div>
        <div class="row gy-2" id="accommodation_type_container">
        @foreach($accommodations as $row)
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--success text--success">
                            <i class="fas fa-users icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="mb-0">{{ $row->guests->count() }} Guests</h3>
                             <p>{{$row->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        </div>
            
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Bed Type</h5>
                </div>
            </div>
        </div>
        <div class="row gy-4" id="bed_type_container">
            @php
        $total_type = 0;
        @endphp
        @foreach($accommodations as $type)
        @php
        $total_type += $type->newBedTypes->count();
        @endphp
        @if(!auth()->guard('admin')->user()->accommodation_id)
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">{{$type->newBedTypes->count()}}</h3>
                             <p>{{$type->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        @foreach($type->newBedTypes as $bedtype)
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                            <h3 class="mb-0">{{$bedtype->beds->count()}} Beds</h3>
                             <p>Bed Type {{$bedtype->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        @endforeach
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">{{$total_type}}</h3>
                             <p>Total Bed Type</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title text-dark">Bed Key</h5>
                </div>
            </div>
        </div>
        @php
        $total_key = 0;
        @endphp
        @foreach($accommodations as $type)
        @php
        $keys = \App\Models\RoomKey::whereHas('bed',function($q) use($type) {
            $q->where('accommodation_id',$type->id);
        })->count();
        $total_key += $keys;
        @endphp
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">{{$keys}}</h3>
                             <p>{{$type->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        <div class="col-xxl-3 col-sm-6 position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="widget-two__icon b-radius--5   border border--primary bg-primary">
                            <i class="la la-city icon-color-efs"></i>
                        </div>
                        <div class="widget-two__content">
                                <h3 class="mb-0" id="total">{{$total_key}}</h3>
                             <p>Total Bed Key</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>




@endsection

@push('script')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>

    <script>
        "use strict";

        //last one 12 month booking graph
        var options = {
            series: [{
                name: 'Total Booking Amount',
                data: [
                    @foreach ($months as $month)
                        {{ getAmount(@$bookingMonth->where('months', $month)->first()->bookingAmount) }},
                    @endforeach
                ]
            }],
            chart: {
                type: 'bar',
                height: 450,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($months),
            },
            yaxis: {
                title: {
                    text: "{{ __($general->cur_sym) }}",
                    style: {
                        color: '#7c97bb'
                    }
                }
            },
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "{{ __($general->cur_sym) }}" + val + " "
                    }
                }
            }
        };


        var chart = new ApexCharts(document.querySelector("#apex-bar-chart-1"), options);
        chart.render();


        // apex-line chart
        var options = {
            chart: {
                height: 450,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#28c76f', '#ea5455', '#546E7A', '#E91E63', '#FF9800'],
            series: [{
                    name: "Received",
                    data: [
                        @foreach ($trxReport['date'] as $trxDate)
                            {{ @$plusTrx->where('date', $trxDate)->first()->amount ?? 0 }},
                        @endforeach
                    ]
                },
                {
                    name: "Returned",
                    data: [
                        @foreach ($trxReport['date'] as $trxDate)
                            {{ @$minusTrx->where('date', $trxDate)->first()->amount ?? 0 }},
                        @endforeach
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    @foreach ($trxReport['date'] as $trxDate)
                        "{{ $trxDate }}",
                    @endforeach
                ]
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        chart.render();

        var ctx = document.getElementById('userBrowserChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_browser_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_browser_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                maintainAspectRatio: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });



        var ctx = document.getElementById('userOsChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_os_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_os_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.05)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            },
        });


        // Donut chart
        var ctx = document.getElementById('userCountryChart');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($chart['user_country_counter']->keys()),
                datasets: [{
                    data: {{ $chart['user_country_counter']->flatten() }},
                    backgroundColor: [
                        '#ff7675',
                        '#6c5ce7',
                        '#ffa62b',
                        '#ffeaa7',
                        '#D980FA',
                        '#fccbcb',
                        '#45aaf2',
                        '#05dfd7',
                        '#FF00F6',
                        '#1e90ff',
                        '#2ed573',
                        '#eccc68',
                        '#ff5200',
                        '#cd84f1',
                        '#7efff5',
                        '#7158e2',
                        '#fff200',
                        '#ff9ff3',
                        '#08ffc8',
                        '#3742fa',
                        '#1089ff',
                        '#70FF61',
                        '#bf9fee',
                        '#574b90'
                    ],
                    borderColor: [
                        'rgba(231, 80, 90, 0.75)'
                    ],
                    borderWidth: 0,

                }]
            },
            options: {
                aspectRatio: 1,
                responsive: true,
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
    <script>
    
    $('#change-accommodation').change(function (e)
            {
                e.preventDefault();
                var accommodation = $(this).val();
                if(!accommodation){
                    window.location.reload();
                }
                var created_at = $('#change-date').val();
                console.log('accommodation'+ accommodation);
                 $.ajax({
                    type:'POST',
                    url:"{{ route('admin.get-dashboard-data') }}",
                    data:{
                        accommodation:accommodation,
                        created_at:created_at,
                        _token:"{{csrf_token()}}"
                    },
                    success:function(data){
                        console.log(data);
                      $('#amenities').text(data.amenities);
                      $('#rooms').text(data.beds);
                      $('#beds').text(data.rooms);
                      $('#today_booked').text(data.today_booked);
                      $('#today_available').text(data.today_available);
                      $('#active').text(data.active);
                      $('#total').text(data.total);
                      $('#pending_checkin').text(data.pending_checkin);
                      $('#delayed_checkout').text(data.delayed_checkout);
                      $('#upcoming_checkin').text(data.upcoming_checkin);
                      $('#upcoming_checkout').text(data.upcoming_checkout);
                      $('#occupiedBedsId').text(data.occupiedBedsId);
                      $('#vacant_beds').text(data.vacant_beds);
                      $('#vacant_rooms').text(data.vacant_rooms);
                      $('#bed_type_container').html(data.bed_types_data);
                      $('#accommodation_type_container').html(data.accommodation_types_data);
                      
                     displayRoomTypes(data.roomTypesWithCounts);
                     
                    }
                });
            });
    
     $('#change-date').change(function (e)
            {
                e.preventDefault();
                var accommodation = $('#change-accommodation').val();
                var created_at = $('#change-date').val();
                console.log('accommodation'+ accommodation);
                 $.ajax({
                    type:'POST',
                    url:"{{ route('admin.get-dashboard-data') }}",
                    data:{
                        accommodation:accommodation,
                        created_at:created_at,
                        _token:"{{csrf_token()}}"
                    },
                    success:function(data){
                        console.log(data);
                      $('#amenities').text(data.amenities);
                      $('#rooms').text(data.beds);
                      $('#beds').text(data.rooms);
                      $('#today_booked').text(data.today_booked);
                      $('#today_available').text(data.today_available);
                      $('#active').text(data.active);
                      $('#total').text(data.total);
                      $('#pending_checkin').text(data.pending_checkin);
                      $('#delayed_checkout').text(data.delayed_checkout);
                      $('#upcoming_checkin').text(data.upcoming_checkin);
                      $('#upcoming_checkout').text(data.upcoming_checkout);
                      $('#occupiedBedsId').text(data.occupiedBedsId);
                      $('#vacant_beds').text(data.vacant_beds);
                      $('#vacant_rooms').text(data.vacant_rooms);
                      $('#bed_type_container').html(data.bed_types_data);
                       $('#accommodation_type_container').html(data.accommodation_types_data);
                      
                     displayRoomTypes(data.roomTypesWithCounts);
                     
                    }
                });
            });
            
            function displayRoomTypes(roomTypes) {
                
                var roomTypesContainer = $('#roomTypesContainer');
                roomTypesContainer.empty();
                roomTypes.forEach(function (roomType) {
                    var html = `<div class="col-xxl-3 col-sm-6 position-relative gy-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="widget-two__icon b-radius--5 border border--primary bg-primary">
                                        <i class="la la-city icon-color-efs"></i>
                                    </div>
                                    <div class="widget-two__content">
                                        <h6 class="mb-0">${roomType.name} - ${roomType.accommodation.name}</h6>
                                        <p>Room Count: ${roomType.rooms_count}</p>
                                    </div>
                                </div>
                            </div>
                            <a href="/admin/hotel/room?roomType=${roomType.id}&accommodation=${roomType.accommodation.id}" class="widget-two__btn btn btn-outline--primary" style="cursor: pointer">View All</a>
                        </div>
                    </div>`;
                    roomTypesContainer.append(html);
                });
            }

    </script>
@endpush
