@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                   <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <a type="buttom" class="btn btn-primary" href="/create/new/token">Request New Auth Ticket</a>
                            </div>
                       </div>
                   </div>
                   <form class="form"  method="POST">
                        @csrf
                        <div class="row ">
                            <div class="col-md-12">
                                <label for="refresh_token" class="col-form-label">Generate new access token in database</label>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="refresh_token" id="refresh_token" placeholder=" Refresh Token">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Generate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
