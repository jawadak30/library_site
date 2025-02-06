@extends('basedashboard')
@section('aside')
@include('admin.admin_components.aside')
@endsection

@section('nav')
    @include('admin.admin_components.nav')
@endsection
@section('banner')
    @include('admin.admin_components.banner')
@endsection

@section('container_fluid')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-lg-6">
            <div class="profile-content tab-content">
                <div class="tab-pane fade active show">
                    <div class="card">
                        <div class="card-header">
                            <div class="header-title">
                                <h4 class="card-title">Admin Profile</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div class="mt-3">
                                    <!-- Display Admin's Name -->
                                    <h3 class="d-inline-block">{{ $user->name }}</h3>

                                    <!-- Display Admin's Role -->
                                    <p class="d-inline-block pl-3"> - {{ ucfirst($user->role) }}</p>

                                    <!-- Display Admin's Email -->
                                    <p class="mb-1"><strong>{{ trans('mainTrans.email') }}:</strong> {{ $user->email }}</p>

                                    <!-- Display Last Login Time -->
                                    <p class="mb-1">
                                        <strong>{{ trans('mainTrans.last_login') }}:</strong>
                                        {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('Y-m-d H:i') : 'Never' }}

                                    </p>

                                    <!-- Display Account Creation Time -->
                                    <p class="mb-1">
                                        <strong>{{ trans('mainTrans.account_created') }}:</strong>
                                        {{ $user->created_at->format('Y-m-d H:i:s') }}
                                    </p>

                                    <!-- Display Email Verification Status -->
                                    <p class="mb-1">
                                        <strong>{{ trans('mainTrans.Email_Verified') }}:</strong>
                                        {{ $user->email_verified_at ? 'Yes' : 'No' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('settings')
    @include('admin.admin_components.settings')
@endsection
