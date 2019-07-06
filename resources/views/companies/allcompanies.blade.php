@extends('layouts.logged-in')

@section('content')
    <div class="companies">
    <div id="cover">
                <!-- <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="">  -->
        </div>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#newCompany">
                    Add Company
            </button><br><br>
            <table class="table-bordered table-hover" id="companiesTable" style="width: 100%!important;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Website</th>
                        <th>Logo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                            <tr data-toggle="modal" data-target="#editCompany{{$company->id}}">
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td>{{$company->website}}</td>
                                <td>
                                    <img src="{{$company->logo}}" alt="logo" height="100px" width="100px">
                                </td>
                            </tr>
                        <div class="modal fade" id="editCompany{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
                                    </div>
                                    <div class="modal-body">
                                            <form action="/companies/{{$company->id}}" method="POST" autocomplete="new-password" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('PATCH')
                                                <input type="hidden" value="{{$company->id}}" name="id">
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
                                                                 type="search"
                                                                 name="email"
                                                                 value="{{$company->email}}"
                                                                 required>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                        <label for="email" class="col-sm-2 form-control-label">Website</label>
                                                        <div class="col-sm-6">
                                                          <input class="form-control"
                                                                 type="search"
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
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              <button type="submit" value="submit" class="btn btn-primary">Save</button>
                                              <button type="submit" value="submit" class="btn btn-danger" formaction="/companies/{{$company->id}}/delete">Delete</button>
                                            </form>
                                            <a href="/companies/{{$company->id}}"><button class="btn btn-success">View Company As Manager</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
    </div>
     {{-- <!-- Create New Company Modal --> --}}
 <div class="modal fade" id="newCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Create New Company</h4>
            </div>
            <div class="modal-body">
                  <form action="/companies" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group row">
                            <label for="name" class="col-sm-2 form-control-label">Name</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="name"
                                     placeholder="Company Name"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="email"
                                     placeholder="Company Email"
                                     required>
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="website" class="col-sm-2 form-control-label">Website</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="text"
                                     name="website"
                                     placeholder="Company Website"
                                    >
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="password" class="col-sm-2 form-control-label">Logo</label>
                            <div class="col-sm-6">
                              <input class="form-control"
                                     type="file"
                                     name="logo"
                                     placeholder="Company Logo"
                                    >
                            </div>
                    </div>
                      <button type="submit" class="btn btn-primary">Add New Company</button>
                  </form>
            </div>
          </div>
        </div>
</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
        function viewCompanyAsManager(){
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
          console.log('hitting');
        }
    </script>
@endsection