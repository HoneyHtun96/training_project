@extends('backendtemplate')

@section('content')

    <h1 class="h3 mb-4 text-gray-800"> Expense </h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary"> All Expenses
                <a href="{{route('expenses.create')}}" class="btn btn-outline-primary float-right btn-sm"> <i class="fas fa-plus mr-2"></i>Add New</a>
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Attachments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($expenses as $expense)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$expense->type}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{$expense->description}}</td>
                                <td>{{$expense->date}}</td>
                                <td>
                                
                                    @php
                                        $images = explode(',', $expense->attachment);
                                    @endphp
                                    @foreach($images as $row) 
                                        <img src="{{$row}}" width="80" height="80" onclick="showImage(this,'<?php echo $row ?>')">
                                    @endforeach
                                                
                                </td>
                                <td>
                                    <a href="{{route('expenses.edit',$expense->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                 
                                    <form method="post" action="{{route('expenses.destroy',$expense->id)}}" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="myModal" class="modal">
        <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
        <img class="modal-content" id="img">
        <div id="caption"></div>
    </div>

@endsection

@section('script')
<script>
     function showImage(element,i){
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg'+i);
    var modalImg = document.getElementById("img");
    var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = element.src;
        captionText.innerHTML = element.alt;
   }
</script>
@endsection

<style type="text/css">
.modal {
    display: none; 
    position: fixed; 
    z-index: 1;
    padding-top: 100px;
    margin-top: 50px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto;
    vertical-align: middle;
}
.modal-content{
    width: 80%;
    max-width: 700px; 
    height:500; 
    margin: auto;
    display: block;
}

.close {
  position: absolute;
  top: 70px;
  right: 400px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
</style>