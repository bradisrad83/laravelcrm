@extends('layouts.logged-in')

@section('content')
    <div class="users">
    <div id="cover">
                <!-- <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="">  -->
        </div>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newUser">
                    Add User
            </button><br><br>
            <table class="table-bordered table-hover" id="usersTable" style="width: 100%!important;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Role</th>
                        <th>Company</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allUsers as $currentUser)
                            <tr data-toggle="modal" data-target="#editUser{{$currentUser->id}}">
                                <td>{{$currentUser->name}}</td>
                                <td>{{$currentUser->email}}</td>
                                <td>{{$currentUser->role->name}}</td>
                                @if(isset($currentUser->company))
                                    <td>{{$currentUser->company->name}}</td>
                                @else   
                                    <td></td>
                                @endif
                            </tr>
                            <div class="modal fade" id="editUser{{$currentUser->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                                    </div>
                                    <div class="modal-body">
                                            <form action="/users/{{$currentUser->id}}" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('PATCH')
                                                <input type="hidden" value="{{$currentUser->id}}" name="id">
                                                <div class="form-group row">
                                                        <label for="name" class="col-sm-2 form-control-label">Name</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="text"
                                                                 name="name"
                                                                 value="{{$currentUser->name}}"
                                                                 required>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="email" class="col-sm-2 form-control-label">Email</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="text"
                                                                 name="email"
                                                                 value="{{$currentUser->email}}"
                                                                 required>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="password" class="col-sm-2 form-control-label">Password</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="text"
                                                                 name="password"
                                                                 placeholder="User's New Password"
                                                                 >
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="role" class="col-sm-2 form-control-label">Role</label>
                                                    <div class="col-sm-6">
                                                        <select id="role" name="role">
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="role" class="col-sm-2 form-control-label">Change Companies?</label>
                                                    <div class="col-sm-6">
                                                        <select id="company_id" name="company_id">
                                                            <option value="null">Leave Here if A Change Is Not Needed</option>
                                                            @foreach($companies as $company)
                                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              <button type="submit" value="submit" class="btn btn-primary">Save</button>
                                              <button type="submit" value="submit" class="btn btn-danger" formaction="/users/{{$currentUser->id}}/delete">Delete</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>                            
                    @endforeach
                </tbody>
            </table>
    </div>
<!-- Create New User Modal -->
 <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Create New User</h4>
            </div>
            <div class="modal-body">
                  <form action="/users" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group row">
                            <label for="name" class="col-sm-2 form-control-label">Name</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="name"
                                     placeholder="User Name"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="email"
                                     placeholder="User Email"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Password</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="password"
                                     placeholder="User Password"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="role" class="col-sm-2 form-control-label">Role</label>
                            <div class="col-sm-6">
                                <select id="role" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 form-control-label">Company They Manage</label>
                            <div class="col-sm-6">
                                <select id="company_id" name="company_id">
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add New User</button>
                  </form>
            </div>
          </div>
        </div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
    </script>
@endsection