<?php
$encrypter = app('Illuminate\Encryption\Encrypter');
$encrypted_token = $encrypter->encrypt(csrf_token());
?>
@extends('layouts.app')
@section('content')
<div class="container">
    <button class="btn-success btn-sm" id="btn-add"><i class="fa fa-plus-circle"></i> Add</button><br/><br/>
    <div class="alert alert-danger info" style="display:none;">
      <ul></ul>
    </div>
    <div class="row">
        <table id="example" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="person-list" name="person-list">
            @foreach($person as $persons)
                <tr id="person{{ $persons->id }}">
                    <td>{{ $persons->first_name }}</td>
                    <td>{{ $persons->last_name }}</td>
                    <td>{{ $persons->address }}</td>
                    <td>{{ $persons->city }}</td>
                    <td>{{ $persons->email }}</td>
                    <td>
                        <button class="btn btn-xs btn-primary open-modal" value="{{$persons->id}}"><i class="glyphicon glyphicon-edit"></i> Edit</button>
                        <button class="btn btn-xs btn-danger delete" value="{{$persons->id}}"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Person Form</h4>
              </div>
              <div class="modal-body">
              {!! Form::open(array('id' => 'frm', 'name' => 'frm', 'class' => 'form-horizontal')) !!}
              <input id="token" type="hidden" value="{{$encrypted_token}}">
              @include('person._form')  
              {!! Form::close() !!}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <!-- Modal -->
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/t/dt/dt-1.10.11/datatables.min.js"></script>
{!! HTML::script("/js/app.js") !!}
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
});
</script>