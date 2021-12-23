@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session()->get('success')}}
    <a type="button" class="close" data-dismiss="alert" aria-label="Close">
        <h4 aria-hidden="true">&times;</h4>
    </a>
</div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session()->get('error')}}
        <a type="button" class="close" data-dismiss="alert" aria-label="Close">
            <h4 aria-hidden="true">&times;</h4>
        </a>
    </div>
@elseif(session()->has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session()->get('info')}}
        <a type="button" class="close" data-dismiss="alert" aria-label="Close">
            <h4 aria-hidden="true">&times;</h4>
        </a>
    </div>
@elseif(session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{session()->get('warning')}}
        <a type="button" class="close" data-dismiss="alert" aria-label="Close">
            <h4 aria-hidden="true">&times;</h4>
        </a>
    </div>
@endif
