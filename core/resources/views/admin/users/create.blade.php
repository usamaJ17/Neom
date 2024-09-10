@extends('admin.layouts.app')
@section('panel')
    <div class="container">
        <form method="post" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>

                <div class="form-group col-md-6 col-lg-6">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>
            

            <div class="form-group col-md-6">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            
            <div class="form-group col-md-6 col-lg-6">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group col-md-6 col-lg-6">
                <label for="nationality">Nationality:</label>
                <input type="text" name="nationality" class="form-control" required>
            </div>

            <div class="form-group col-md-6 col-lg-6">
                <label for="passport_iqama">Passport/Iqama:</label>
                <input type="text" name="passport_no" class="form-control" required>
            </div>

            <!--<div class="row">-->
                <div class="form-group col-md-6">
                    <label for="gender">Gender:</label>
                    <select name="gender" class="form-control" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        {{-- Add more options as needed --}}
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="department">Department:</label>
                    <input type="text" name="department" class="form-control" required>
                </div>
            <!--</div>-->

            <div class="form-group col-md-6">
                <label for="designation">Designation:</label>
                <input type="text" name="designation" class="form-control" required>
            </div>

            <div class="form-group  col-md-6">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" name="contact_number" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label for="main_company">Main Company:</label>
                <input type="text" name="company" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label for="project_site">Project Site:</label>
                <input type="text" name="project" class="form-control" required>
            </div>
             <div class="form-group col-md-6">
                <label for="country_code">Country Code:</label>
                <input type="text" name="country_code" class="form-control" required>
            </div>
            
            <div class="form-group col-md-6">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            </div>

            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <textarea name="remarks" class="form-control" rows="3"></textarea>
            </div>

           

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
            </div>

            

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection