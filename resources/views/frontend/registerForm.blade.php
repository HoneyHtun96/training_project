@extends('template')
@section('content')
    
    <!-- Header -->
    <header class="py-5 mb-5 header_img">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h1 class="display-4 text-white mt-5 mb-2"> New Student Register Form </h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
       
                <form id="inquireStudent"  class="my-5" enctype="multipart/form-data">
                
                    <input type="hidden" name="inquireno" value="{{$inquireno}}" id="inquireno">
                    <input type="hidden" name="batch_id" value="{{$inquire->batch_id}}" id="batch_id">
                    <h5 class="my-3"><u>Student Informations:</u></h5>
                  
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNameEnglish">Student's Name: (English)</label>
                            <input type="text" class="form-control @error('namee') is-invalid @enderror" id="inputNameEnglish" placeholder="Mg Mg" name="namee" value="{{ $inquire->name }}" required autocomplete="namee" >
                      
                            @error('namee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="inputNameMyanmar">Student's Name: (Myanmar)</label>
                            <input type="text" class="form-control @error('namem') is-invalid @enderror" id="inputNameMyanmar" placeholder="မောင်မောင်" name="namem" value="{{ old('namem') }}" required autocomplete="namem" autofocus>
                            
                            @error('namem')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEducation"> Degree:</label>
                            <input type="text" class="form-control @error('degree') is-invalid @enderror" id="inputCity" name="degree" value="{{ old('education') }}" required autocomplete="degree" >
                            
                            @error('degree')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group col-md-4">
                            <label for="inputCity">City:</label>
                            <select class="form-control @error('city') is-invalid @enderror" id="inputCity" placeholder="Yangon" name="city" value="{{ old('city') }}" required autocomplete="city" >
                                @foreach($townships as $township)
                                    <option value="{{$township->id}}" {{($township->id == $inquire->township_id)?"selected":""}}>{{$township->name}}</option>
                                @endforeach
                            </select>
                                {{--<input type="text" class="form-control @error('city') is-invalid @enderror" id="inputCity" placeholder="Yangon" name="city" value="{{ old('city') }}" required autocomplete="city" >--}}
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-2">
                            <label for="inputAcceptedYear">Accepted Year:</label>
                            <input type="text" class="form-control @error('accepted_year') is-invalid @enderror" id="inputAcceptedYear" placeholder="2015" name="accepted_year" value="{{ $inquire->acceptedyear }}" required autocomplete="accepted_year" >
                            
                            @error('accepted_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputAddress">Address:</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="1234 Main St" name="address" value="{{ old('address') }}" required autocomplete="address" ></textarea>
                        
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail4" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" >
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Phone:</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPassword4" placeholder="Phone" name="phone" value="{{ $inquire->phone}}" required autocomplete="phone" >
                      
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDOB">Date of Birth:</label>
                            <input type="date" class="form-control @error('dob') is-invalid @enderror" id="inputDOB" name="dob" value="{{ old('dob') }}" required autocomplete="dob" >
                            
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group col-md-6" id="inputGender">
                            <label for="inputGender" class="d-block">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" name="gender" {{($inquire->gender=="male")?"checked" : ""}}>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" name="gender" {{($inquire->gender=="female")?"checked" : ""}}>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="font-weight-bold col-md-12">Which Programming Language did you know? ( လက်ရှိကျွမ်းကျင်တဲ့ programming language )</label>

                    
                        @foreach($subjects as $subject)
                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input subjects" type="checkbox" id="gridCheck{{$subject->id}}" value="{{$subject->id}}" name="subjects[]">
                                    <label class="form-check-label d-inline" for="gridCheck{{$subject->id}}">
                                        {{$subject->name}}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="bg-dark">

                    <h5 class="my-3"><u>Household Parent / Guardian Information:</u></h5>
                  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputParent1">Parent/Guardian #1:</label>
                            <input type="text" class="form-control @error('p1') is-invalid @enderror" placeholder="Name" id="inputParent1" name="p1" value="{{ old('p1') }}" required autocomplete="p1" >
                            
                            @error('p1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group col-md-4">
                            <label for="inputParent1Rs">Relationship of Student</label>
                            <input type="text" class="form-control @error('p1_rs') is-invalid @enderror" id="inputParent1Rs" placeholder="" name="p1_rs" value="{{ old('p1_rs') }}" required autocomplete="p1_rs" >
                      
                            @error('p1_rs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group col-md-4">
                            <label for="inputParent1Phone">Phone:</label>
                            <input type="text" class="form-control @error('p1_phone') is-invalid @enderror" id="inputParent1Phone" placeholder="" name="p1_phone" value="{{ old('p1_phone') }}" required autocomplete="p1_phone" >
                      
                            @error('p1_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputParent2">Parent/Guardian #2:</label>
                            <input type="text" class="form-control @error('p2') is-invalid @enderror" placeholder="Name" id="inputParent2" name="p2" value="{{ old('p2') }}" required autocomplete="p2" >
                            
                            @error('p2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputParent2Rs">Relationship of Student</label>
                            <input type="text" class="form-control @error('p2_rs') is-invalid @enderror" id="inputParent2Rs" placeholder="" name="p2_rs" value="{{ old('p2_rs') }}" required autocomplete="p2_rs"  >
                            
                            @error('p2_rs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputParent2Phone">Phone:</label>
                            <input type="text" class="form-control @error('p2_phone') is-invalid @enderror" id="inputParent2Phone" placeholder="" name="p2_phone" value="{{ old('p2_phone') }}" required autocomplete="p2_phone" >
                      
                            @error('p2_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <hr class="bg-dark">

                    <div class="form-group">
                        <label for="inputInformation" class="font-weight-bold">သင်တန်းတွေအများကြီးထဲက Myanmar IT Consulting သင်တန်းကို ရွေးချယ်ရတဲ့ အကြောင်းအရင်းကို သိပါရစေ။</label>
                        <textarea class="form-control @error('because') is-invalid @enderror" id="inputInformation" placeholder="Please ...." name="because" value="{{ old('because') }}" required autocomplete="because" ></textarea>
                    
                        @error('because')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block register_btn">Save Register</button>
                 
                </form>
            </div>
        </div>

    </div>


<!-- Successful Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-center">
                <p>Register Successfully!!</p>
                <a href="{{route('login')}}">
                    <button type="button" class="btn btn-primary">OK</button>
                </a>
            </div>
            <div class="modal-footer ">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#inquireStudent').submit(function(event){
    
            event.preventDefault();
            var formdata=new FormData(this);
    
            $.ajax({
                url: "{{route('students.store')}}",
                data: formdata,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    // $('#exampleModal').modal('show');
                },
                error: function(request, status, error) {
                    console.log("error")
                }

            });
        }); 
    })
</script>
@endsection