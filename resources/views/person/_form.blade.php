<div class="alert alert-danger info" style="display:none;">
    <ul></ul>
</div>
<div class="form-group">
    <label class="col-md-4 control-label">First Name</label>
    <div class="col-md-8">
        {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Last Name</label>
    <div class="col-md-8">
        {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Address</label>
    <div class="col-md-8">
        {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'address', 'rows' => 5]) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">City</label>
    <div class="col-md-8">
        {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Post Code</label>
    <div class="col-md-8">
        {!! Form::text('postal_code', null, ['class' => 'form-control', 'id' => 'postal_code']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label">Email</label>
    <div class="col-md-8">
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
    </div>
</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-3 col-md-9">
            {!! Form::button('Save', array('class' => 'btn-primary save')) !!}
            {!! Form::hidden('id', null, ['id' => 'id']) !!}
        </div>
    </div>
</div>