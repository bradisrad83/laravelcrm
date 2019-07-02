@extends('layouts.logged-in')

@section('content')
    <div class="company">
        <button class="btn btn-primary" data-toggle="modal" data-target="#editCompany">Edit Company Details</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#newEmployee">Add Employee</button>
        <h2>Company Name: {{$company->name}}<h2>
        <h3>Company Email: {{$company->email}}<h3>
        <h3>Company Website: {{$company->website}}<h3>
        <img src="{{$company->logo}}">
        <h3>Employees</h3>
        <table class="table-bordered table-hover" id="employeeTable" style="width: 100%!important;">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            @foreach($company->employees as $employee)
                <tr data-toggle="modal" data-target="#editEmployee{{$employee->id}}">
                    <td>{{$employee->first_name}}</td>
                    <td>{{$employee->last_name}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                </tr>
                <div class="modal fade" id="editEmployee{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
                                    </div>
                                    <div class="modal-body">
                                            <form action="/employees/{{$employee->id}}" method="POST" autocomplete="new-password" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('PATCH')
                                                <div class="form-group row">
                                                        <label for="first_name" class="col-sm-2 form-control-label">First Name</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="text"
                                                                 name="first_name"
                                                                 value="{{$employee->first_name}}"
                                                                 required>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="last_name" class="col-sm-2 form-control-label">Last Name</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="search"
                                                                 name="last_name"
                                                                 value="{{$employee->last_name}}"
                                                                 required>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="email" class="col-sm-2 form-control-label">Email</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="search"
                                                                 name="email"
                                                                 value="{{$employee->email}}"
                                                                 >
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="phone" class="col-sm-2 form-control-label">Phone Number</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="search"
                                                                 name="phone"
                                                                 value="{{$employee->phone}}"
                                                                 >
                                                        </div>
                                                </div>
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              <button type="submit" value="submit" class="btn btn-primary">Save</button>
                                              <button type="submit" value="submit" class="btn btn-danger" formaction="/employees/{{$employee->id}}/delete">Delete</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            @endforeach
    </div>

<!-- Edit Company Modal -->
<div class="modal fade" id="editCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Company Details</h4>
            </div>
            <div class="modal-body">
                  <form action="/companies/{{$company->id}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      @method('PATCH')
                      <div class="form-group row">
                            <label for="name" class="col-sm-2 form-control-label">Name</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="name"
                                     value="{{$company->name}}"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="email"
                                     value="{{$company->email}}"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Website</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="website"
                                     value="{{$company->website}}"
                                     >
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 form-control-label">Logo</label>
                            <div class="col-sm-6">
                                <input class="form-control"
                                    type="file"
                                    name="logo"
                                    value="{{$company->logo}}"
                                    >
                                </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
          </div>
        </div>
</div>

<!-- Create New Employee Modal -->
<div class="modal fade" id="newEmployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Edit Company Details</h4>
            </div>
            <div class="modal-body">
                  <form action="/employees" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      
                      <div class="form-group row">
                            <label for="first_name" class="col-sm-2 form-control-label">First Name</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="first_name"
                                     placeholder="Employee First Name"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="last_name" class="col-sm-2 form-control-label">Last Name</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="last_name"
                                     placeholder="Employee Last Name"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="email"
                                     placeholder="Employee Email"
                                     >
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="phone" class="col-sm-2 form-control-label">Phone Number</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="phone"
                                     placeholder="Employee Phone Number"
                                     >
                            </div>
                    </div>
                    <input name="company_id" type="hidden" value="{{$company->id}}">
                    <button type="submit" class="btn btn-primary">Create New Employee</button>
                  </form>
            </div>
          </div>
        </div>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
    </script>
@endsection