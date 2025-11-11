@extends('layouts.limitless')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="page-header page-header-light shadow">
                <div class="page-header-content d-lg-flex">
                    <div class="d-flex">
                        <h4 class="page-title mb-0">
                            Home - <span class="fw-normal">Dashboard</span>
                        </h4>

                        <a href="#page_header"
                            class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                            data-bs-toggle="collapse">
                            <i class="ph ph-caret-down collapsible-indicator ph-sm m-1"></i>
                        </a>
                    </div>


                </div>

                <div class="page-header-content d-lg-flex border-top">
                    <div class="d-flex">
                        <div class="breadcrumb py-2">
                            <a href="index.html" class="breadcrumb-item"><i class="ph ph-house"></i></a>
                            <a href="#" class="breadcrumb-item">Home</a>
                            <span class="breadcrumb-item active">Dashboard</span>
                        </div>

                        <a href="#breadcrumb_elements"
                            class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                            data-bs-toggle="collapse">
                            <i class="ph ph-caret-down collapsible-indicator ph-sm m-1"></i>
                        </a>
                    </div>


                </div>
            </div>
            <div class="content">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Dashboard</h5>
                    </div>
                    <div class="card-body">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
