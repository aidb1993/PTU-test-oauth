@extends('layouts.app')
<style>
    .fixed-layout {
  table-layout: fixed;
}
.fixed-layout > tbody > tr > td {
  text-overflow: ellipsis;
  margin-bottom: 12px;
  word-break: break-all;
  overflow: hidden;
  white-space: nowrap;
}
.fixed-layout > tbody > tr > td:hover {
  overflow: visible;
  white-space: normal;
  height: auto;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                @if(!isset($qboAuth))
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <a type="buttom" class="btn btn-primary" target="_blank" href="/create/new/token">Request New Auth Ticket</a>
                            </div>
                       </div>
                   </div>
                   <form class="form"  method="POST" action="{{ url('qbo_auth') }}">
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
                   @else
                   <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table fixed-layout">
                                   <tbody>
                                       <tr>
                                           <td>
                                               Realm ID
                                           </td>
                                           <td>
                                               {{ $qboAuth['realm_id'] }}
                                           </td>
                                       </tr>
                                       <tr>
                                            <td>
                                                Access Token
                                            </td>
                                            <td>
                                                {{ $qboAuth['access_token'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Expires
                                            </td>
                                            <td>
                                                {{ $qboAuth['expires_in'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Refresh Token Expires
                                            </td>
                                            <td>
                                                {{ $qboAuth['x_refresh_token_expires_in'] }}
                                            </td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
